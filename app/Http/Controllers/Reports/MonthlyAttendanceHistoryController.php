<?php

namespace App\Http\Controllers\Reports;

use Carbon\Carbon;
use App\Models\Shift;
use App\Models\Branch;
use App\Models\Employee;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\While_;
use App\Models\AttendanceLogData;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\DateRangeTrait;
use App\Http\Controllers\Controller;

class MonthlyAttendanceHistoryController extends Controller
{
    use DateRangeTrait;

    public function index()
    {
        $years = $this->yearRange();
        $months = $this->monthRange();
        $branchs = Branch::get();
        $shifts = Shift::get();

        $branch = 1;
        $shift = 1;
        $year = Carbon::now()->format('Y');
        // $month = Carbon::now()->format('m');
        $month = '03';

        $att_month = (int)$month;


        // dd($month);
    
        $slectedDate  = Carbon::parse($year . '-' . $month . '-01 00:00:00');
        $dates = [];
        for ($i = 1; $i < $slectedDate->daysInMonth + 1; ++$i) {
            $dates[] = Carbon::createFromDate($slectedDate->year, $slectedDate->month, $i)->format('y-m-d');
        }



        $data = DB::select(DB::raw("select
        a.date_year,
        month(a.full_date) as Months,
        a.full_date,
        a.date_day,
        `users`.`id` AS `UserID`,
        `buzk_log_data`.`user_id` AS `EmpUserID`,
        `users`.`name` AS `UserName`,
        min(cast(`buzk_log_data`.`att_time` as date)) AS `LoginDate`,
        `employees`.`shift_id` AS `ShiftID`,
        `employees`.`branch_id` AS `BranchID`,
        `employees`.`department_id` AS `DepartmentID`,
        `employees`.`designation_id` AS `DesignationID`,
        `shifts`.`absent_time` AS `AbsentTime`,`shifts`.`start_time` AS `AttendanceTime`,
        `shifts`.`grace_time` AS `GraceTime`,`shifts`.`end_time` AS `OfficeEndTime`,
        min(cast(`buzk_log_data`.`att_time` as time)) AS `LoginTime`,
        max(cast(`buzk_log_data`.`update_time` as time)) AS `LogoutTime`,
        `el`.`leave_type_id` AS `LeavTypeID`,
        `el`.`leave_start_date` AS `leave_start`,
        `el`.`leave_end_date` AS `leave_end`,
        `el`.`leave_cause` AS `leave_cause`,
        `el`.`approval_status` AS `leav_approval_status`,
        `hr`.`week_day_name` AS `week_days`,
        `hr`.`week_is_weekend` AS `week_ends`,
        case 
        when min(cast(`buzk_log_data`.`att_time` as time)) <= `shifts`.`absent_time` and min(cast(`buzk_log_data`.`att_time` as time)) > `shifts`.`grace_time` then 'Lt' 
        when min(cast(`buzk_log_data`.`att_time` as time)) >= `shifts`.`start_time` and min(cast(`buzk_log_data`.`att_time` as time)) <= `shifts`.`grace_time` then 'Pr' 
        when min(cast(`buzk_log_data`.`att_time` as time)) >= `shifts`.`absent_time` then 'Ab'
        when min(cast(`buzk_log_data`.`att_time` as time))= 'NULL' && a.full_date in (select end_date from holidays where branch_id=1) then 'Lv'
        when hr.week_day_name=(select week_day_name from hr_weekends where week_is_weekend='Y') then 'We' 
        else 'Ab'
        end AS `AttendanceStatus` 
        from `appsouls_calender` as a inner join `users`
        left join `employees` on `employees`.`user_id` = `users`.`id` 
        left join `buzk_log_data` on `employees`.`dev_emp_id` = `buzk_log_data`.`user_id` 
        left join `buzk_log_data` on `a`.`full_date` = date(`buzk_log_data`.`att_time`) 
        join `shifts` on `shifts`.`id` = `employees`.`shift_id`
        left join `employee_leaves`  as el 
        on `el`.`user_id` = `users`.`id`
        left join `hr_weekends` as hr on `hr`.`week_day_name` =`a`.`date_day`
        where a.date_year=2022 and month(a.full_date)=3 and `employees`.`shift_id`=1 and `employees`.`branch_id`=1
        group by a.full_date,users.id;"));





        dd($data);
        $users = DB::table('employees as e')
        ->leftjoin('users as u', 'e.user_id', '=', 'u.id')
        // ->where('branch_id', $branch)
        // ->where('shift_id', $shift)
        ->whereNotNull('e.dev_emp_id')
        ->select('u.name','e.dev_emp_id')->get();
        //dd($users);

        // $punched_user = DB::table('buzk_log_data')->whereYear('att_time','2022')->whereMonth('att_time','03')->distinct('user_id')->pluck('user_id');
        // dd($punched_user);
        $data = DB::table('employee_monthly_attendance_all_modified')->whereIn('Dates',$dates)->get();


        $results = array();
        foreach ($users as $key => $users) {
            $newarr = array();
            $newarr['EmpName'] = $users->name;
            $newarr['dev_emp_id'] = $users->dev_emp_id;

            foreach ($dates as $date) {
                
                    $newarr['date'] = DB::table('employee_monthly_attendance_all_modified')->where('Dates',$date)->get();

            }

            // $newarr['UserName'] = $value->UserName;
            // $newarr['DevUserId'] = $value->DevUserId;
            // $newarr['LoginDate'] = $value->LoginDate;
            // $newarr['LoginTime'] = $value->LoginTime;
            // $newarr['AttendanceStatus'] = $value->AttendanceStatus;

            $results[] = $newarr;
        }
        dd($results);

        return view('layouts.reports.monthly_attendance_history', compact('branchs','shifts','years','months','dates', 'users', 'data'));
    }

    public function getHistory(Request $request)
    {
        $years = $this->yearRange();
        $months = $this->monthRange();
        $branchs = Branch::get();
        $shifts = Shift::get();

        $branch = $request->branch;
        $shift = $request->shift;
        $year = $request->year;
        $month = $request->month;
        $att_month = (int)$month;

        $slectedDate  = Carbon::parse($year . '-' . $month . '-01 00:00:00');
        $dates = [];
        for ($i = 1; $i < $slectedDate->daysInMonth + 1; ++$i) {
            $dates[] = Carbon::createFromDate($slectedDate->year, $slectedDate->month, $i)->format('d');
        }

        $users = DB::table('employees as e')
        ->join('users as u', 'e.user_id', '=', 'u.id')
        ->where('branch_id', $branch)
        ->where('shift_id', $shift)
        ->pluck('u.name','e.dev_emp_id as user_id');
        //dd($users);

        $data = DB::select(DB::raw("select `a`.`date_year` AS `Years`,
        month(`a`.`full_date`) AS `Months`,
        `a`.`full_date` AS `Dates`,
        `a`.`date_day` AS Days,
        `users`.`id` AS `UserID`,
        `users`.`name` AS `UserName`,
        `employees`.`shift_id` AS `ShiftID`,`employees`.`branch_id` AS `BranchID`,
        `employees`.`department_id` AS `DepartmentID`,
        `employees`.`designation_id` AS `DesignationID`,
        `shifts`.`absent_time` AS `AbsentTime`,
        `shifts`.`start_time` AS `AttendanceTime`,
        `shifts`.`grace_time` AS `GraceTime`,
        `shifts`.`end_time` AS `OfficeEndTime`,
        min(cast(`buzk_log_data`.`att_time` as time)) AS `LoginTime`,
        max(cast(`buzk_log_data`.`att_time` as time)) AS `LogoutTime`,
        `el`.`leave_type_id` AS `LeavTypeID`,
        `el`.`leave_start_date` AS `leave_start`,
        `el`.`leave_end_date` AS `leave_end`,
        `el`.`leave_cause` AS `leave_cause`,
        `el`.`approval_status` AS `leav_approval_status`,
        `hr`.`week_day_name` AS `week_days`,
        `hr`.`week_is_weekend` AS `week_ends`,
        (case 
        when ((min(cast(`buzk_log_data`.`att_time` as time)) <= `shifts`.`absent_time`) and (min(cast(`buzk_log_data`.`att_time` as time)) > `shifts`.`grace_time`)) then 'Lt' 
        when ((min(cast(`buzk_log_data`.`att_time` as time)) >= `shifts`.`start_time`) and (min(cast(`buzk_log_data`.`att_time` as time)) <= `shifts`.`grace_time`)) then 'Pr' 
        when (min(cast(`buzk_log_data`.`att_time` as time)) >= `shifts`.`absent_time`) then 'Ab' 
        when ((min(cast(`buzk_log_data`.`att_time` as time)) = 'NULL') 
        and `a`.`full_date` in (select `holidays`.`end_date` from `holidays` where (`holidays`.`branch_id` = 1))) then 'Lv' 
        when (`hr`.`week_day_name` = (select `hr_weekends`.`week_day_name` from `hr_weekends` where (`hr_weekends`.`week_is_weekend` = 'Y'))) then 'We' 
        else 'Ab' end) AS `AttendanceStatus` 
        from ((((((`appsouls_calender` `a` inner join `users`) 
        left join `employees` on((`employees`.`dev_emp_id` = `users`.`id`))) 
        left join `buzk_log_data` on((`a`.`full_date` = cast(`buzk_log_data`.`att_time` as date)))) 
        join `shifts` on((`shifts`.`id` = `employees`.`shift_id`))) 
        left join `employee_leaves` `el` on((`el`.`user_id` = `users`.`id`))) 
        left join `hr_weekends` `hr` on((convert(`hr`.`week_day_name` using utf8mb4) = `a`.`date_day`))) 
        where ((`a`.`date_year` = 2022) and (month(`a`.`full_date`) = 1) 
        and (`employees`.`shift_id` = 1) and (`employees`.`branch_id` = 1)) 
        group by `a`.`full_date`,users.id,buzk_log_data.user_id;"));

        //dd($data);
        
        return view('layouts.reports.monthly_attendance_history', compact('branchs','shifts','years','months','dates', 'users', 'data'));
    }
}

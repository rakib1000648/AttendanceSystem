<?php

namespace App\Http\Controllers\Reports;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\AttendanceLogData;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\DateRangeTrait;
use App\Http\Controllers\Controller;
use App\Models\Employee;

class MonthlyPresentSummeryController extends Controller
{
    use DateRangeTrait;

    public function index()
    {
        $year = $this->yearRange();
        $month = $this->monthRange();

        $ChosenYear = '2022';
        $ChosenMonth = '03';
                
        $calendars = DB::table('appsouls_calender')->whereYear('full_date',$ChosenYear)->whereMonth('full_date',$ChosenMonth)->pluck('full_date');

        // $users_id = AttendanceLogData::whereYear('att_time',$ChosenYear)->whereMonth('att_time',$ChosenMonth)->distinct('user_id')->pluck('user_id');
        $users_id = Employee::WhereNotNull('dev_emp_id')->distinct('dev_emp_id')->pluck('dev_emp_id');

        //dd($users_id);
        $userData = DB::table('employees as e')
            ->select('e.user_id', 'e.dev_emp_id','e.employee_image as photo', 'u.name as username', 'dprt.department_name', 'desig.designation','s.shift_name','s.start_time as office_start','s.grace_time','s.absent_time')
            ->leftjoin('users as u', 'e.user_id', '=', 'u.id')
            ->leftjoin('designations as desig', 'e.designation_id', '=', 'desig.id')
            ->leftjoin('departments as dprt', 'e.department_id', '=', 'dprt.id')
            ->leftjoin('shifts as s', 'e.shift_id', '=', 's.id')
            ->WhereNotNull('dev_emp_id')
            ->get();

        $punchData = DB::table('monthly_punch_history_all')->selectRaw('DevUserId as punch_user_id, Dates, login')
        ->whereYear('Dates',$ChosenYear)->whereMonth('Dates',$ChosenMonth)
        ->whereIn('DevUserId', $users_id)
        ->get();

        // $punchData = DB::table('buzk_log_data')->selectRaw('user_id as punch_user_id, att_time')
        // ->whereYear('att_time',$ChosenYear)->whereMonth('att_time',$ChosenMonth)
        // ->whereIn('user_id', $users_id)
        // ->orderBy('att_time')
        // ->get()->dd();

        // $results = array();
        // foreach ($userData as $user) {

        //     $newarr = array();
        //     $newarr['username'] = $user->username;
        //     $newarr['user_id'] = $user->user_id;
        //     $newarr['dev_emp_id'] = $user->dev_emp_id;
        //     $newarr['photo'] = $user->photo;
        //     $newarr['department_name'] = $user->department_name;
        //     $newarr['designation'] = $user->designation;
        //     $newarr['shift_name'] = $user->shift_name;
        //     $newarr['office_start'] = $user->office_start;
        //     $newarr['grace_time'] = $user->grace_time;
        //     $newarr['absent_time'] = $user->absent_time;


        //     foreach ($punchData as $punch) {
        //         if ($newarr['dev_emp_id'] == $punch->punch_user_id) {

        //             $newarr['att_time'] = $punch->login;
                    
        //             if ($newarr['first_punch'] < $newarr['grace_time']) {
        //                 $newarr['marking'] = 'Present';
        //             }elseif($newarr['first_punch'] > $newarr['grace_time'] && $newarr['first_punch'] < $newarr['absent_time']) {
        //                 $newarr['marking'] = 'Late';
        //             }
        //             elseif($newarr['first_punch'] > $newarr['absent_time']) {
        //                 $newarr['marking'] = 'Absent';
        //             }                    
        //         }
        //     }
        //     $results[] = $newarr;
        // }


        $results = array();
        foreach ($userData as $user) {

            $newarr = array();
            $newarr['username'] = $user->username;
            $newarr['user_id'] = $user->user_id;
            $newarr['dev_emp_id'] = $user->dev_emp_id;
            $newarr['photo'] = $user->photo;
            $newarr['department_name'] = $user->department_name;
            $newarr['designation'] = $user->designation;
            $newarr['shift_name'] = $user->shift_name;
            $newarr['office_start'] = $user->office_start;
            $newarr['grace_time'] = $user->grace_time;
            $newarr['absent_time'] = $user->absent_time;


            $results[] = $newarr;
        }
            dd($results);

        
       return view('layouts.reports.monthly_present_summery',compact('year','month'));
    }
}

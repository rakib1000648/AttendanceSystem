<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Shift;
use App\Models\Branch;
use App\Models\Employee;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use App\Models\EmployeeLeave;
use App\Models\EmployeeLeaveType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PDF;

class EmployeeLeaveController extends Controller
{
    public function index()
    {
        $no = 1;
        $data = DB::table('employee_leaves as el')
        ->leftJoin('employees', 'el.user_id', '=', 'employees.dev_emp_id')
        ->leftJoin('users as u',function ($join)
            {
                $join->on('employees.user_id','=','u.id');
            })
        ->leftJoin('users as approver', 'el.approver_id', '=', 'approver.id')
        ->leftJoin('employee_leave_types', 'el.leave_type_id', '=', 'employee_leave_types.id')
        ->select('el.*', 'employee_leave_types.type','u.name', 'approver.name as appr_name')
        ->orderByDesc('id')
        ->get();

        return view('layouts.employee.leave',compact('data','no'));
    }

    public function createEmployeeLeave()
    {
        $employee = DB::table('employees')
            ->leftJoin('users', 'employees.user_id', '=', 'users.id')
            ->select('employees.dev_emp_id', 'users.name')
            ->get();
        $leave_type = EmployeeLeaveType::get();

        return view('layouts.employee.create-leave',compact('employee','leave_type'));
    }

    public function addEmployeeLeave(Request $request)
    {
       $validateData = $request->validate([
            'user_id' => 'required',
            'leave_type_id' => 'required',
            'leave_start_date' => 'required|date',
            'leave_end_date' => 'required|date|after_or_equal:start_date',
            'leave_cause' => 'required',
       ]);

       $status =  1;
       $approver = Auth::id();

       EmployeeLeave::create(array_merge($validateData,['approval_status' => $status], ['approver_id' => $approver]));
       return redirect('leaves');
    }

    public function editEmployeeLeave($id)
    {
        $employee = DB::table('employees')
        ->leftJoin('users', 'employees.user_id', '=', 'users.id')
        ->select('employees.dev_emp_id', 'users.name')
        ->get();
        $leave_type = EmployeeLeaveType::get();

        $data = EmployeeLeave::where('id',$id)->first();
        return view('layouts.employee.edit-leave',compact('data','employee','leave_type'));
    }

    public function updateEmployeeLeave(Request $request)
    {
       $validateData = $request->validate([
        'user_id' => 'required',
        'leave_type_id' => 'required',
        'leave_start_date' => 'required|date',
        'leave_end_date' => 'required|date|after_or_equal:start_date',
        'leave_cause' => 'required',
       ]);
       $status =  1;
       $approver = Auth::id();

       EmployeeLeave::where('id',$request->id)->update(array_merge($validateData,['approval_status' => $status], ['approver_id' => $approver]));
       return redirect('leaves');
    }

    public function deleteEmployeeLeave($id)
    {
        EmployeeLeave::where('id',$id)->delete();
        return redirect('leaves');
    }

    public function approveEmployeeLeave($id)
    {
        $approver = Auth::id();
        EmployeeLeave::where('id',$id)->update(['approver_id' => $approver, 'approval_status' => 2]);
        return redirect('leaves');
    }

    public function rejectEmployeeLeave($id)
    {
        $rejector = Auth::id();
        EmployeeLeave::where('id',$id)->update(['approver_id' => $rejector,'approval_status' => 3]);
        return redirect('leaves');
    }

    public function monthlyLeaveReport($branch_id = null, $year = null)
    {

        if ($branch_id != 0) {
            $branch = Branch::get();
            $year_period = CarbonPeriod::create('2018-01-01','P1Y', '2030-01-01');
            $period = $year_period->toArray();

            $employee_id = Employee::where('branch_id',$branch_id)->pluck('dev_emp_id');

            Session::forget('branch_id_for_leave');
            Session::put('branch_id_for_leave', $branch_id);

            //dd($employee_id);
            $no = 1;
            if ($year) {
                $final_year = $year;
                Session::forget('year');
                Session::put('year', $year);
            } else {
                $final_year = Carbon::now()->format('Y');
                Session::forget('year');
                Session::put('year', $final_year);
            }



            $toatl_leaves = DB::table('employee_leaves as el')
            ->leftJoin('employees', 'el.user_id', '=', 'employees.dev_emp_id')
            ->leftJoin('users as u',function ($join)
                {
                    $join->on('employees.user_id','=','u.id');
                })

            ->leftjoin('designations as desig', 'employees.designation_id', '=', 'desig.id')
            ->where('approval_status',2)
            ->whereIn('dev_emp_id', $employee_id)
            ->whereYear('leave_start_date',$final_year)
            ->groupBy('user_id')
            ->select('el.*','u.name', 'designation', DB::raw("SUM(DATEDIFF(leave_end_date, leave_start_date) + 1) AS leave_total"))
            ->get();


            $results = array();
            foreach ($toatl_leaves as $key => $data) {

                    $newarr = array();
                    $newarr['user_id'] = $data->user_id;
                    $newarr['name'] = $data->name;
                    $newarr['designation'] = $data->designation;
                    $newarr['leave_total'] = $data->leave_total;

                    $newarr['annual_total'] = EmployeeLeave::whereYear('leave_start_date',$final_year)
                    ->where('user_id', $newarr['user_id'])
                    ->where('leave_type_id', 1)
                    ->sum(DB::raw("DATEDIFF(leave_end_date, leave_start_date) + 1"));

                    $newarr['casual_total'] = EmployeeLeave::whereYear('leave_start_date',$final_year)
                    ->where('user_id', $newarr['user_id'])
                    ->where('leave_type_id', 2)
                    ->sum(DB::raw("DATEDIFF(leave_end_date, leave_start_date) + 1"));

                    $newarr['sick_total'] = EmployeeLeave::whereYear('leave_start_date',$final_year)
                    ->where('user_id', $newarr['user_id'])
                    ->where('leave_type_id', 3)
                    ->sum(DB::raw("DATEDIFF(leave_end_date, leave_start_date) + 1"));


                $results[] = $newarr;

            }
            //dd($results);
            Session::forget('leave_report_results');
            Session::put('leave_report_results', $results);



            return view('layouts.employee.leave-yearly',compact('branch','period','results','no'));
        } else {
            $branch = Branch::get();
            $branch_id = 0;
            $year_period = CarbonPeriod::create('2018-01-01','P1Y', '2030-01-01');
            $period = $year_period->toArray();

            Session::forget('branch_id_for_leave');
            Session::put('branch_id_for_leave', $branch_id);

            $no = 1;

            if ($year) {
                $final_year = $year;
                Session::forget('year');
                Session::put('year', $year);
            } else {
                $final_year = Carbon::now()->format('Y');
                Session::forget('year');
                Session::put('year', $final_year);
            }

            $toatl_leaves = DB::table('employee_leaves as el')
            ->leftJoin('employees', 'el.user_id', '=', 'employees.dev_emp_id')
            ->leftJoin('users as u',function ($join)
                {
                    $join->on('employees.user_id','=','u.id');
                })

            ->leftjoin('designations as desig', 'employees.designation_id', '=', 'desig.id')
            ->where('approval_status',2)
            ->whereYear('leave_start_date',$final_year)
            ->groupBy('user_id')
            ->select('el.*','u.name', 'designation', DB::raw("SUM(DATEDIFF(leave_end_date, leave_start_date) + 1) AS leave_total"))
            ->get();


            $results = array();
            foreach ($toatl_leaves as $key => $data) {

                    $newarr = array();
                    $newarr['user_id'] = $data->user_id;
                    $newarr['name'] = $data->name;
                    $newarr['designation'] = $data->designation;
                    $newarr['leave_total'] = $data->leave_total;

                    $newarr['annual_total'] = EmployeeLeave::whereYear('leave_start_date',$final_year)
                    ->where('user_id', $newarr['user_id'])
                    ->where('leave_type_id', 1)
                    ->sum(DB::raw("DATEDIFF(leave_end_date, leave_start_date) + 1"));

                    $newarr['casual_total'] = EmployeeLeave::whereYear('leave_start_date',$final_year)
                    ->where('user_id', $newarr['user_id'])
                    ->where('leave_type_id', 2)
                    ->sum(DB::raw("DATEDIFF(leave_end_date, leave_start_date) + 1"));

                    $newarr['sick_total'] = EmployeeLeave::whereYear('leave_start_date',$final_year)
                    ->where('user_id', $newarr['user_id'])
                    ->where('leave_type_id', 3)
                    ->sum(DB::raw("DATEDIFF(leave_end_date, leave_start_date) + 1"));


                $results[] = $newarr;
            }
            Session::forget('leave_report_results');
            Session::put('leave_report_results', $results);
               // dd($results);

            return view('layouts.employee.leave-yearly',compact('branch','period','results','no'));
        }


    }

    public function generateLeaveReportPDF()
    {
        if (Session::get('branch_id_for_leave')) {
            $branch = Branch::where('id',Session::get('branch_id_for_leave'))->first();
        } else {
            $branch = 'All';
        }

        $report = Session::get('leave_report_results');

        $data = [
            'sl' => 1,
            'data' => $report,
            'branch' => $branch,
            'year' => Session::get('year')
        ];

        $pdf = PDF::loadView('layouts.employee.leave-report-file', $data);
        return $pdf->download('Leaves_report.pdf');
    }
}

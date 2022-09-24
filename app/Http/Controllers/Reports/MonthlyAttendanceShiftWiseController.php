<?php

namespace App\Http\Controllers\Reports;

use App\Models\Shift;
use App\Models\Branch;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\DateRangeTrait;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class MonthlyAttendanceShiftWiseController extends Controller
{
    use DateRangeTrait;
    public function index()
    {
        $users = DB::table('employees as e')
        ->leftjoin('users as u', 'e.user_id', '=', 'u.id')
        ->leftjoin('designations as desg', 'e.designation_id', '=', 'desg.id')
        ->leftjoin('departments as dpt', 'e.department_id', '=', 'dpt.id')
        ->leftjoin('branches as b', 'e.branch_id', '=', 'b.id')
        ->leftjoin('shifts as s', 'e.shift_id', '=', 's.id')
        ->whereNotNull('e.dev_emp_id')
        ->select('e.dev_emp_id','e.user_id','u.name','desg.designation','dpt.department_name','b.branch_name','s.shift_name')
        ->get();

        return view('layouts.reports.monthly_all_shift_attendance',compact('users'));
    }
    public function punchReacord($user_id)
    {
        $years = $this->yearRange();
        $months = $this->monthRange();

        $user_id = $user_id;
        $seletedYear = Carbon::now()->format('Y');
        $seletedMonth = Carbon::now()->format('m');

        $data_common = DB::table('employee_monthly_attendance_all_modified as e')
        ->select('e.*','dsg.designation','dpt.department_name','b.branch_name','s.shift_name')
        ->leftJoin('shifts as s','e.ShiftID','s.id')
        ->leftJoin('branches as b','e.BranchID','b.id')
        ->leftJoin('departments as dpt','e.DepartID','dpt.id')
        ->leftJoin('designations as dsg','e.DesigID','dsg.id')
        ->whereYear('Dates',$seletedYear)
        ->whereMonth('Dates',$seletedMonth)
        ->where('DevUserId',$user_id)
        ->first();

        // dd($data_common);
        
        $data = DB::table('employee_monthly_attendance_all_modified')
        ->whereYear('Dates',$seletedYear)
        ->whereMonth('Dates',$seletedMonth)
        ->where('DevUserId',$user_id)
        ->get();

        Session::forget('data_common');
        Session::put('data_common', $data_common);
        Session::forget('data');
        Session::put('data', $data);
        Session::forget('seletedYear');
        Session::put('seletedYear', $seletedYear);
        Session::forget('seletedMonth');
        Session::put('seletedMonth', $seletedMonth);

        return view('layouts.reports.monthly_punch_records',compact('data_common','user_id','data','years','months','seletedYear','seletedMonth'));
    }
    public function dateWise(Request $request)
    {
        $years = $this->yearRange();
        $months = $this->monthRange();

        $user_id = $request->user_id;
        $seletedYear = $request->year;
        $seletedMonth = $request->month;
        

        $data_common = DB::table('employee_monthly_attendance_all_modified as e')
        ->select('e.*','dsg.designation','dpt.department_name','b.branch_name','s.shift_name')
        ->leftJoin('shifts as s','e.ShiftID','s.id')
        ->leftJoin('branches as b','e.BranchID','b.id')
        ->leftJoin('departments as dpt','e.DepartID','dpt.id')
        ->leftJoin('designations as dsg','e.DesigID','dsg.id')
        ->whereYear('Dates',$request->year)
        ->whereMonth('Dates',$request->month)
        ->where('DevUserId',$user_id)
        ->first();

        $data = DB::table('employee_monthly_attendance_all_modified')
        ->whereYear('Dates',$request->year)
        ->whereMonth('Dates',$request->month)
        ->where('DevUserId',$user_id)
        ->get();

        Session::forget('data_common');
        Session::put('data_common', $data_common);
        Session::forget('data');
        Session::put('data', $data);
        Session::forget('seletedYear');
        Session::put('seletedYear', $seletedYear);
        Session::forget('seletedMonth');
        Session::put('seletedMonth', $seletedMonth);

        return view('layouts.reports.monthly_punch_records',compact('data_common','user_id','data','years','months','seletedYear','seletedMonth'));
    }
    public function generatePDF()
    {
        $seletedYear =Session::get('seletedYear');
        $seletedMonth =Session::get('seletedMonth');

        $results = [
            'data_common' => Session::get('data_common'),
            'data' => Session::get('data'),
            'seletedYear' => $seletedYear,
            'seletedMonth' => $seletedMonth,
        ];
        $pdf = PDF::loadView('layouts.reports.pdf.monthly_punch_records', $results);
        return $pdf->download($seletedYear.'-'.$seletedMonth.'_monthly_punch_records.pdf');
    }
}

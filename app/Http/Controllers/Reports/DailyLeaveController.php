<?php

namespace App\Http\Controllers\Reports;

use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class DailyLeaveController extends Controller
{
    public function index()
    {
        $fullDate = Carbon::now()->format('Y-m-d');
        $results = DB::table('employee_leaves as el')
        ->select('el.*', 'lt.type','u.name', 'approver.name as appr_name')
        ->leftJoin('employees', 'el.user_id', '=', 'employees.dev_emp_id')
        ->leftJoin('users as u',function ($join)
            {
                $join->on('employees.user_id','=','u.id');
            })
        ->leftJoin('users as approver', 'el.approver_id', '=', 'approver.id')
        ->leftJoin('employee_leave_types as lt', 'el.leave_type_id', '=', 'lt.id')
        ->whereDate('leave_start_date', '<=', $fullDate)->whereDate('leave_end_date', '>=', $fullDate)
        ->orderByDesc('id')
        ->get();

        Session::forget('results');
        Session::put('results', $results);
        Session::forget('fullDate');
        Session::put('fullDate', $fullDate);
        
        return view('layouts.reports.daily_leave',compact('results','fullDate'));
    }
    public function dateWise(Request $request)
    {
        $fullDate = $request->fullDate;
        
        $results = DB::table('employee_leaves as el')
        ->select('el.*', 'lt.type','u.name', 'approver.name as appr_name')
        ->leftJoin('employees', 'el.user_id', '=', 'employees.dev_emp_id')
        ->leftJoin('users as u',function ($join)
            {
                $join->on('employees.user_id','=','u.id');
            })
        ->leftJoin('users as approver', 'el.approver_id', '=', 'approver.id')
        ->leftJoin('employee_leave_types as lt', 'el.leave_type_id', '=', 'lt.id')
        ->whereDate('leave_start_date', '<=', $fullDate)->whereDate('leave_end_date', '>=', $fullDate)
        ->orderByDesc('id')
        ->get();

        Session::forget('results');
        Session::put('results', $results);
        Session::forget('fullDate');
        Session::put('fullDate', $fullDate);
        
        return view('layouts.reports.daily_leave',compact('results','fullDate'));
    }
    public function generatePDF()
    {
        $date =Session::get('fullDate');
        $results = [
            'fullDate' => Session::get('fullDate'),
            'results' => Session::get('results'),
        ];
        $pdf = PDF::loadView('layouts.reports.pdf.daily_leave', $results);
        return $pdf->download($date.'_daily_leave.pdf');
    }
}

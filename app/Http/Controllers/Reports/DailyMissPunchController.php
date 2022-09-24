<?php

namespace App\Http\Controllers\Reports;

use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\AttendanceLogData;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class DailyMissPunchController extends Controller
{
    public function index()
    {
        $fullDate = Carbon::now()->format('Y-m-d');
        $users_id = AttendanceLogData::whereDate('att_time', $fullDate)->distinct('user_id')->pluck('user_id');

        $results = DB::table('employees as e')
            ->select('e.user_id', 'e.dev_emp_id', 'e.employee_image as photo', 'u.name as username', 'dprt.department_name', 'desig.designation', 's.shift_name', 's.start_time as office_start', 's.grace_time', 's.absent_time')
            ->leftjoin('users as u', 'e.user_id', '=', 'u.id')
            ->leftjoin('designations as desig', 'e.designation_id', '=', 'desig.id')
            ->leftjoin('departments as dprt', 'e.department_id', '=', 'dprt.id')
            ->leftjoin('shifts as s', 'e.shift_id', '=', 's.id')
            ->whereNotNull('e.dev_emp_id')
            ->whereNotIn('e.dev_emp_id',$users_id)
            ->get();

            Session::forget('results');
            Session::put('results', $results);
            Session::forget('fullDate');
            Session::put('fullDate', $fullDate);

        return view('layouts.reports.daily_miss_punch',compact('results','fullDate'));
    }
    public function DateWise(Request $request)
    {
        $fullDate = $request->fullDate;
        $users_id = AttendanceLogData::whereDate('att_time', $fullDate)->distinct('user_id')->pluck('user_id');

        $results = DB::table('employees as e')
            ->select('e.user_id', 'e.dev_emp_id', 'e.employee_image as photo', 'u.name as username', 'dprt.department_name', 'desig.designation', 's.shift_name', 's.start_time as office_start', 's.grace_time', 's.absent_time')
            ->leftjoin('users as u', 'e.user_id', '=', 'u.id')
            ->leftjoin('designations as desig', 'e.designation_id', '=', 'desig.id')
            ->leftjoin('departments as dprt', 'e.department_id', '=', 'dprt.id')
            ->leftjoin('shifts as s', 'e.shift_id', '=', 's.id')
            ->whereNotNull('e.dev_emp_id')
            ->whereNotIn('e.dev_emp_id',$users_id)
            ->get();

            Session::forget('results');
            Session::put('results', $results);
            Session::forget('fullDate');
            Session::put('fullDate', $fullDate);

        return view('layouts.reports.daily_miss_punch',compact('results','fullDate'));
    }
    public function generatePDF()
    {
        $date =Session::get('fullDate');
        $results = [
            'fullDate' => Session::get('fullDate'),
            'results' => Session::get('results'),
        ];
        $pdf = PDF::loadView('layouts.reports.pdf.daily_miss_punch', $results);
        return $pdf->download($date.'_daily_miss_punch.pdf');
    }
}

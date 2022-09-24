<?php

namespace App\Http\Controllers\Reports;

use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\AttendanceLogData;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class DailyLateSummeryController extends Controller
{
    public function index()
    {

        $fullDate = Carbon::now()->format('Y-m-d');        
        $users_id = AttendanceLogData::whereDate('att_time',$fullDate)->distinct('user_id')->pluck('user_id');
        
        $userData = DB::table('employees as e')
            ->select('e.user_id', 'e.dev_emp_id','e.employee_image as photo', 'u.name as username', 'dprt.department_name', 'desig.designation','s.shift_name','s.start_time as office_start','s.grace_time','s.absent_time')
            ->leftjoin('users as u', 'e.user_id', '=', 'u.id')
            ->leftjoin('designations as desig', 'e.designation_id', '=', 'desig.id')
            ->leftjoin('departments as dprt', 'e.department_id', '=', 'dprt.id')
            ->leftjoin('shifts as s', 'e.shift_id', '=', 's.id')
            ->whereIn('e.dev_emp_id',$users_id)
            ->get();

        $punchData = DB::table('buzk_log_data')->selectRaw('user_id as punch_user_id, MIN(att_time) AS first_punch')
        ->whereDate('att_time',$fullDate)
        ->whereIn('user_id', $users_id)
        ->orderBy('att_time')
        ->groupBy('user_id')
        ->get();

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

            foreach ($punchData as $punch) {
                if ($newarr['dev_emp_id'] == $punch->punch_user_id) {

                    $newarr['first_punch'] = Carbon::parse($punch->first_punch)->format('H:i:s');
                    
                    if ($newarr['first_punch'] < $newarr['grace_time']) {
                        $newarr['marking'] = 'Present';
                    }elseif($newarr['first_punch'] > $newarr['grace_time'] && $newarr['first_punch'] < $newarr['absent_time']) {
                        $newarr['marking'] = 'Late';
                    }
                    elseif($newarr['first_punch'] > $newarr['absent_time']) {
                        $newarr['marking'] = 'Absent';
                    }                    
                }
            }
            $results[] = $newarr;
        }
            //dd($results);
            Session::forget('results');
            Session::put('results', $results);
            Session::forget('fullDate');
            Session::put('fullDate', $fullDate);
        return view('layouts.reports.daily_late_summary',compact('results'));
    }


    public function DateWise(Request $request)
    {
        $fullDate = $request->fullDate;        
        $users_id = AttendanceLogData::whereDate('att_time',$fullDate)->distinct('user_id')->pluck('user_id');
        //dd($users_id);

        $userData = DB::table('employees as e')
            ->select('e.user_id', 'e.dev_emp_id','e.employee_image as photo', 'u.name as username', 'dprt.department_name', 'desig.designation','s.shift_name','s.start_time as office_start','s.grace_time','s.absent_time')
            ->leftjoin('users as u', 'e.user_id', '=', 'u.id')
            ->leftjoin('designations as desig', 'e.designation_id', '=', 'desig.id')
            ->leftjoin('departments as dprt', 'e.department_id', '=', 'dprt.id')
            ->leftjoin('shifts as s', 'e.shift_id', '=', 's.id')
            ->whereIn('e.dev_emp_id',$users_id)
            ->get();


        $punchData = DB::table('buzk_log_data')->selectRaw('user_id as punch_user_id, MIN(att_time) AS first_punch')
        ->whereDate('att_time',$fullDate)
        ->whereIn('user_id', $users_id)
        ->orderBy('att_time')
        ->groupBy('user_id')
        ->get();

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

            foreach ($punchData as $punch) {
                if ($newarr['dev_emp_id'] == $punch->punch_user_id) {

                    $newarr['first_punch'] = Carbon::parse($punch->first_punch)->format('H:i:s');
                    
                    if ($newarr['first_punch'] < $newarr['grace_time']) {
                        $newarr['marking'] = 'Present';
                    }elseif($newarr['first_punch'] > $newarr['grace_time'] && $newarr['first_punch'] < $newarr['absent_time']) {
                        $newarr['marking'] = 'Late';
                    }
                    elseif($newarr['first_punch'] > $newarr['absent_time']) {
                        $newarr['marking'] = 'Absent';
                    }                    
                }
            }
            $results[] = $newarr;
        }
            //dd($results);
            Session::forget('results');
            Session::put('results', $results);
            Session::forget('fullDate');
            Session::put('fullDate', $fullDate);
        return view('layouts.reports.daily_late_summary',compact('results','fullDate'));
    }
    public function generatePDF()
    {
        $date =Session::get('fullDate');
        $results = [
            'fullDate' => Session::get('fullDate'),
            'results' => Session::get('results'),
        ];
        $pdf = PDF::loadView('layouts.reports.pdf.daily_late_summary', $results);
        return $pdf->download($date.'_daily_late_summary.pdf');
    }
}

<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\Shift;
use App\Models\Branch;
use App\Models\Holiday;
use App\Models\Employee;
use Carbon\CarbonPeriod;
use App\Models\EmployeeLeave;
use App\Models\AttendanceLogData;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class AttendanceMonthlyController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:attendance-report|attendance-download', ['only' => ['index', 'show', 'generatePDF']]);
    }


    public function show($result, $shiftData, $dates = null)
    {

        $sl = 1;

        $year_period = CarbonPeriod::create('2018-01-01', 'P1Y', '2030-01-01');
        $period = $year_period->toArray();

        $data = array();
        foreach ($result as  $value) {
            $data[$value['user_id']][0] = $value;
        }


        dd($data);

        Session::forget('dates');
        Session::forget('data_monthly');
        Session::forget('shiftDataMonthly');

        Session::put('dates', $dates);
        Session::put('data_monthly', $data);
        Session::put('shiftDataMonthly', $shiftData);

        $branch = Branch::get();
        $shift = Shift::get();


        return view('layouts.admin.attendance.att-list-monthly', compact('sl', 'period', 'dates', 'branch', 'shift', 'shiftData'))->with('data', $data);
    }


    public function index($branch_id = null, $year = null, $month = null, $shift_id = null, $type = null)
    {

        if ($year) {
            $chosenYear = $year;
            Session::put('year', $chosenYear);
        } else {
            $chosenYear = Carbon::now()->year;
            Session::put('year', $chosenYear);
        }

        if ($month) {
            $chosenMonth = $month;
            Session::put('month', $chosenMonth);
        } else {
            $chosenMonth = Carbon::now()->month;
            Session::put('month', $chosenMonth);
        }

        //dd(Session::get('month'));

        $slectedDate  = Carbon::parse($chosenYear . '-' . $chosenMonth . '-01 00:00:00');
        $dates = [];
        for ($i = 1; $i < $slectedDate->daysInMonth + 1; ++$i) {
            $dates[] = Carbon::createFromDate($slectedDate->year, $slectedDate->month, $i)->format('d');
        }

        if ($shift_id) {

            $employee_id = Employee::where('branch_id', $branch_id)->where('shift_id', $shift_id)->pluck('dev_emp_id');

            $Shift_users = DB::table('employees as e')
                ->leftjoin('users as u', 'e.user_id', '=', 'u.id')
                ->leftjoin('designations as desig', 'e.designation_id', '=', 'desig.id')
                ->leftjoin('buzk_log_data as l', 'e.dev_emp_id', '=', 'l.user_id')
                ->leftjoin('buzk_devices_list as d',  function ($join) {
                    $join->on('l.dev_id', '=', 'd.id');
                })
                ->whereIn('dev_emp_id', $employee_id)
                ->select('e.*', 'u.name as username', 'designation', 'd.device_name', 'd.dev_ipaddr', 'l.att_time', \DB::raw(
                    '(CASE
                WHEN l.user_id IS NULL THEN "not registered"
                WHEN l.user_id IS NOT NULL THEN "registered"
                END) AS device_status'
                ))
                ->whereYear('att_time',$chosenYear)
                ->whereMonth('att_time',$chosenMonth)
                ->get();

            if ($type == 1) {

                $shiftData = Shift::where('id', $shift_id)->where('type', 1)->first();



                $results = array();
                foreach ($Shift_users as $key => $data) {

                    $lastDayofMonth = Carbon::parse($chosenYear . '-' . $chosenMonth . '-01 00:00:00')->endOfMonth()->format('d');


                    $newarr = array();
                    $newarr['username'] = $data->username;
                    $newarr['employee_image'] = $data->employee_image;
                    $newarr['designation'] = $data->designation;
                    $newarr['user_id'] = $data->dev_emp_id;
                    // $newarr['att_time'] = $data->att_time;
                    $newarr['last_day'] = $lastDayofMonth;
                    $newarr['device_status'] = $data->device_status;




                    $isAttIn = AttendanceLogData::where('user_id', $newarr['user_id'])->whereYear('att_time', $chosenYear)->whereMonth('att_time', $chosenMonth)->exists();

                    if ($isAttIn) {
                        for ($k = 0; $k < count($dates); $k++) {
                            $date = $chosenYear . '-' . $chosenMonth . '-' . $dates[$k];

                            if (Holiday::where('branch_id', $branch_id)->whereDate('start_date', '<=', $date)->whereDate('end_date', '>=', $date)->exists()) {
                                $in_time[$k] = 'H';
                            } else {

                                if (EmployeeLeave::where('user_id', $newarr['user_id'])->where('approval_status', 2)->whereDate('leave_start_date', '<=', $date)->whereDate('leave_end_date', '>=', $date)->exists()) {
                                    $in_time[$k] = 'LV';
                                } else {
                                    $in_time[$k] = DB::table('buzk_log_data')->where('user_id', $newarr['user_id'])->whereDate('att_time', $date)->value('att_time');
                                }
                            }
                        }


                        $newarr['in_time'] = $in_time;
                    } else {
                        $newarr['in_time'] = Null;
                    }

                    $results[] = $newarr;
                }
                //dd($results);



                return $this->show($results, $shiftData, $dates);
            } elseif ($type == 2) {

                $shiftData = Shift::where('id', $shift_id)->where('type', 2)->first();
                $shift_start = Carbon::parse($shiftData->start_time)->subHours(3)->format('H:i:s');

                $results = array();
                foreach ($Shift_users as $key => $data) {

                    $lastDayofMonth =  Carbon::parse($chosenYear . '-' . $chosenMonth . '-01 00:00:00')->endOfMonth()->format('d');

                    $newarr = array();
                    $newarr['username'] = $data->username;
                    $newarr['employee_image'] = $data->employee_image;
                    $newarr['designation'] = $data->designation;
                    $newarr['user_id'] = $data->dev_emp_id;
                    $newarr['shift_start'] = $shift_start;
                    $newarr['last_day'] = $lastDayofMonth;
                    $newarr['device_status'] = $data->device_status;

                    $isAttIn = AttendanceLogData::where('user_id', $newarr['user_id'])->whereYear('att_time', $chosenYear)->whereMonth('att_time', $chosenMonth)->exists();

                    if ($isAttIn) {
                        for ($k = 0; $k < count($dates); $k++) {
                            $date = $chosenYear . '-' . $chosenMonth . '-' . $dates[$k];


                            if (Holiday::where('branch_id', $branch_id)->whereDate('start_date', '<=', $date)->whereDate('end_date', '>=', $date)->exists()) {
                                $in_time[$k] = 'H';
                            } else {

                                if (EmployeeLeave::where('approval_status', 2)->whereDate('leave_start_date', '<=', $date)->whereDate('leave_end_date', '>=', $date)->where('user_id', $newarr['user_id'])->exists()) {
                                    $in_time[$k] = 'LV';
                                } else {
                                    $in_time[$k] = DB::table('buzk_log_data')->whereDate('att_time', $date)->whereTime('att_time', '>=', $newarr['shift_start'])->where('user_id', $newarr['user_id'])->value('att_time');
                                }
                            }
                        }

                        $newarr['in_time'] = $in_time;
                    } else {
                        $newarr['in_time'] = Null;
                    }

                    $results[] = $newarr;
                }
                //dd($results);



                return $this->show($results, $shiftData, $dates);
            }
        } else {
            $chosenYear = Carbon::now()->year;
            $chosenMonth = Carbon::now()->month;

            $slectedDate  = Carbon::parse($chosenYear . '-' . $chosenMonth . '-01 00:00:00');
            $dates = [];
            for ($i = 1; $i < $slectedDate->daysInMonth + 1; ++$i) {
                $dates[] = Carbon::createFromDate($slectedDate->year, $slectedDate->month, $i)->format('d');
            }

            $year_period = CarbonPeriod::create('2018-01-01', 'P1Y', '2030-01-01');
            $period = $year_period->toArray();

            $branch = Branch::get();
            $shift = Shift::get();

            Session::forget('branch_id');
            Session::put('branch_id', $branch_id);

            return view('layouts.admin.attendance.att-list-monthly', compact('period', 'dates', 'branch', 'shift'));
        }
    }


    public function generatePDF()
    {
        $dates = Session::get('dates');
        $data = Session::get('data_monthly');
        $shiftData = Session::get('shiftDataMonthly');

        $data = [
            'sl' => 1,
            'dates' => $dates,
            'data' => $data,
            'shiftData' => $shiftData
        ];

        set_time_limit(300);

        //dd($data);

        $pdf = PDF::loadView('layouts.admin.attendance.att-list-monthly-file', $data)->setPaper('a4', 'landscape');
        return $pdf->download('attendance_data-monthly.pdf');
    }
}

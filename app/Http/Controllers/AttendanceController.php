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

class AttendanceController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:attendance-report|attendance-download', ['only' => ['index', 'show', 'generatePDF']]);
    }

    public function show($result, $shiftData)
    {

        $sl = 1;

        $year_period = CarbonPeriod::create('2018-01-01', 'P1Y', '2030-01-01');
        $years = $year_period->toArray();

        if (Session::get('year')) {
            $chosenYear = Session::get('year');
        } else {
            $chosenYear = Carbon::now()->year;
        }

        if (Session::get('month')) {
            $chosenMonth = Session::get('month');
        } else {
            $chosenMonth = Carbon::today()->format('m');
        }

        $lastDayofMonth =  Carbon::parse($chosenYear . '-' . $chosenMonth . '-01 00:00:00')->endOfMonth()->format('d');
        $day = CarbonPeriod::create($chosenYear . '-' . $chosenMonth . '-01', 'P1D', $chosenYear . '-' . $chosenMonth . '-' . $lastDayofMonth);
        $days = $day->toArray();

        if ($result == 'Holiday') {
            $data = "holiday";
        } else {
            $data = array();
            foreach ($result as  $value) {
                $data[$value['user_id']][0] = $value;
            }
        }


         //dd($data);

        Session::forget('data');
        Session::forget('shiftData');

        Session::put('data', $data);
        Session::put('shiftData', $shiftData);

        $branch = Branch::get();
        $shift = Shift::get();


        // if ($shiftData->type == 1) {
        //     $totalEmployees = Employee::where('shift_id', $shiftData->id)->count();
        //     $punchedEmployees = Count($result);
        //     $unPunchAbsent = $totalEmployees - $punchedEmployees;
        //     $in_time = $result->pluck('in_time');
        //     $shift_absent_time = Carbon::parse($shiftData->absent_time)->format('Y-m-d H:i:s');
        //     $punchedAbsent = $in_time->where('att_time', '>=', $shift_absent_time)->count();
        //     $absent = $punchedAbsent + $unPunchAbsent;
        // } elseif ($shiftData->type == 2) {
        //     $totalEmployees = Employee::where('shift_id', $shiftData->id)->count();
        //     $punchedEmployees = Count($result);
        //     $unPunchAbsent = $totalEmployees - $punchedEmployees;
        //     $in_time = $result->pluck('in_time');
        //     $shift_absent_time = Carbon::parse($shiftData->absent_time)->subDays(1)->format('Y-m-d H:i:s');
        //     $punchedAbsent = $in_time->where('att_time', '>=', $shift_absent_time)->count();
        //     $absent = $punchedAbsent + $unPunchAbsent;
        // }

        // return view('layouts.admin.attendance.att-list', compact('data', 'sl', 'shift', 'shiftData', 'totalEmployees', 'absent'));

        $branchInfo = Branch::where('id', Session::get('branch_id'))->first();

        return view('layouts.admin.attendance.att-list', compact('sl', 'branch', 'years', 'days', 'shift', 'shiftData', 'branchInfo'))->with('data', $data);
    }


    public function index($branch_id = null, $year = null, $month = null, $day = null, $id = null, $type = null)
    {

        if ($branch_id) {
            $branch_id = $branch_id;
        } else {
            $branch_id = '1';
        }


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
            $chosenMonth = Carbon::today()->format('m');
            Session::put('month', $chosenMonth);
        }

        if ($day) {
            $chosenDay = $day;
            Session::put('day', $chosenDay);
        } else {
            $chosenDay = Carbon::today()->format('d');
            Session::put('day', $chosenDay);
        }



        if ($id) {
            $employee_id = Employee::where('branch_id', $branch_id)->where('shift_id', $id)->pluck('dev_emp_id');
            $branch_id = Session::get('branch_id');

            if ($type == 1) {

                $tday = Carbon::today()->format('Y-m-d');
                $isholiday = Holiday::where('branch_id', $branch_id)->where('start_date', '<=', $chosenYear . '-' . $chosenMonth . '-' . $chosenDay)->where('end_date', '>=', $chosenYear . '-' . $chosenMonth . '-' . $chosenDay)->exists();

                $shiftData = Shift::where('id', $id)->where('type', 1)->first();

                if ($isholiday) {
                    $results = 'Holiday';
                    return $this->show($results, $shiftData);
                } else {

                    $dayShift_users = DB::table('employees as e')
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
                        ->get();


                    $today_date_only = $chosenYear . '-' . $chosenMonth . '-' . $chosenDay;

                    $results = array();
                    foreach ($dayShift_users as $key => $data) {




                        for ($i = 0; $i < count($employee_id); $i++) {

                            $isleave[$i] = EmployeeLeave::where('user_id', $employee_id[$i])->where('approval_status', 2)->where('leave_start_date', '<=', $today_date_only)->where('leave_end_date', '>=', $today_date_only)->exists();

                            // $today = Carbon::today();
                            //dd($today);
                            $att_time = Carbon::parse($data->att_time)->format('Y-m-d');

                            $newarr = array();
                            $newarr['username'] = $data->username;
                            $newarr['designation'] = $data->designation;
                            $newarr['device_name'] = $data->device_name;
                            $newarr['dev_ipaddr'] = $data->dev_ipaddr;
                            $newarr['user_id'] = $data->dev_emp_id;
                            $newarr['att_time'] = $data->att_time;
                            $newarr['device_status'] = $data->device_status;

                            if ($data->device_status == 'registered') {

                                    $newarr['in_time'] = AttendanceLogData::where('user_id', $newarr['user_id'])->whereDate('att_time', $today_date_only)->value('att_time');

                                    $newarr['out_time'] = AttendanceLogData::where('user_id', $newarr['user_id'])->whereDate('att_time', $today_date_only)->orderByDesc('att_time')->value('att_time');

                                $newarr['status'] = 'present';
                            } elseif ($data->device_status == 'not registered') {

                                if ($isleave[$i]) {
                                    $newarr['in_time'] = Null;
                                    $newarr['out_time'] = Null;
                                    $newarr['status'] = 'On Leave';
                                } else {
                                    $newarr['in_time'] = Null;
                                    $newarr['out_time'] = Null;
                                    $newarr['status'] = 'absent';
                                }
                            }
                        }
                        $results[] = $newarr;
                    }
                    //dd($results);

                    return $this->show($results, $shiftData);
                }
            } elseif ($type == 2) {

                $isholiday = Holiday::where('branch_id', $branch_id)->where('start_date', '<=', $chosenYear . '-' . $chosenMonth . '-' . $chosenDay)->where('end_date', '>=', $chosenYear . '-' . $chosenMonth . '-' . $chosenDay)->exists();

                $shiftData = Shift::where('id', $id)->where('type', 2)->first();

                if ($isholiday) {
                    //dd('holiday');
                    $results = 'Holiday';
                    return $this->show($results, $shiftData);
                } else {

                    $nightShift_users = DB::table('employees as e')
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
                        ->get();

                    $today_date_only = $chosenYear . '-' . $chosenMonth . '-' . $chosenDay;
                    $tommorow = Carbon::parse($today_date_only)->addDays(1)->format('Y-m-d');

                    $results = array();
                    foreach ($nightShift_users as $key => $data) {

                        for ($i = 0; $i < count($employee_id); $i++) {

                            $isleave[$i] = EmployeeLeave::where('user_id', $employee_id[$i])->where('approval_status', 2)->where('leave_start_date', '<=', $tommorow)->where('leave_end_date', '>=', $tommorow)->exists();


                            $start = Carbon::parse($shiftData->start_time)->subHours(3)->format('H:i:s');
                            $end = Carbon::parse($shiftData->end_time)->addHours(3)->format('H:i:s');


                            $newarr = array();
                            $newarr['username'] = $data->username;
                            $newarr['designation'] = $data->designation;
                            $newarr['device_name'] = $data->device_name;
                            $newarr['dev_ipaddr'] = $data->dev_ipaddr;
                            $newarr['user_id'] = $data->dev_emp_id;

                            $newarr['device_status'] = $data->device_status;

                            if ($data->device_status == 'registered') {


                                $newarr['in_time'] = AttendanceLogData::where('user_id', $newarr['user_id'])->whereDate('att_time', $today_date_only)->WhereTime('att_time', '>=', $start)->value('att_time');

                                $newarr['out_time'] = AttendanceLogData::where('user_id', $newarr['user_id'])->whereDate('att_time', $tommorow)->WhereTime('att_time', '<=', $end)->orderByDesc('att_time')->value('att_time');



                                $newarr['status'] = 'present';
                            } elseif ($data->device_status == 'not registered') {

                                if ($isleave[$i]) {
                                    $newarr['in_time'] = Null;
                                    $newarr['out_time'] = Null;
                                    $newarr['status'] = 'On Leave';
                                } else {
                                    $newarr['in_time'] = Null;
                                    $newarr['out_time'] = Null;
                                    $newarr['status'] = 'absent';
                                }
                            }
                        }
                        $results[] = $newarr;
                    }
                    //dd($results);

                    return $this->show($results, $shiftData);
                }
            }
            // Session::forget('branch_id');
        } else {
            $branch = Branch::get();
            $shift = Shift::get();

            $year_period = CarbonPeriod::create('2018-01-01', 'P1Y', '2030-01-01');
            $years = $year_period->toArray();

            if (Session::get('year')) {
                $chosenYear = Session::get('year');
            } else {
                $chosenYear = Carbon::now()->year;
            }

            if (Session::get('month')) {
                $chosenMonth = Session::get('month');
            } else {
                $chosenMonth = Carbon::today()->format('m');
            }

            $lastDayofMonth =  Carbon::parse($chosenYear . '-' . $chosenMonth . '-01 00:00:00')->endOfMonth()->format('d');
            $day = CarbonPeriod::create($chosenYear . '-' . $chosenMonth . '-01', 'P1D', $chosenYear . '-' . $chosenMonth . '-' . $lastDayofMonth);
            $days = $day->toArray();

            $days = $day->toArray();


            Session::forget('branch_id');
            Session::put('branch_id', $branch_id);

            return view('layouts.admin.attendance.att-list', compact('branch', 'years', 'days', 'shift'));
        }
    }


    public function generatePDF()
    {
        $data = Session::get('data');
        $shiftData = Session::get('shiftData');
        $branchInfo = Branch::where('id', Session::get('branch_id'))->first();

        $data = [
            'today' => Carbon::today()->format('d/m/y'),
            'yesterday' => Carbon::yesterday()->format('d/m/y'),
            'sl' => 1,
            'data' => $data,
            'shiftData' => $shiftData,
            'branchInfo' => $branchInfo
        ];

        $pdf = PDF::loadView('layouts.admin.attendance.attendance-list-file', $data);
        return $pdf->download('attendance_data.pdf');
    }
}

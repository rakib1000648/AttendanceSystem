<?php

namespace App\Http\Controllers\Reports;

use Illuminate\Http\Request;
use App\Http\Traits\DateRangeTrait;
use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Shift;

class MonthlyAttendanceDptDsgController extends Controller
{
    use DateRangeTrait;

    public function index()
    {
        $Department = Department::all();
        $Designation = Designation::all();
        $year = $this->yearRange();
        $month = $this->monthRange();
        
       return view('layouts.reports.monthly_attendance_dpt_dsg',compact('Department','Designation','year','month'));
    }
}

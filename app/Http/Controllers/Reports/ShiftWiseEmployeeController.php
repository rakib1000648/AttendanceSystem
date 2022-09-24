<?php

namespace App\Http\Controllers\Reports;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ShiftWiseEmployeeController extends Controller
{

    public function index($shift = null)
    {

        if ($shift == null || $shift == 'Day') {
            $data= DB::table('shift_wise_employee_info')->where('EmpShift','Day')->get();
        } else {
            $data= DB::table('shift_wise_employee_info_night')->where('EmpShift','Night')->get();
        }
        
    

       return view('layouts.reports.employee_shift_wise',compact('data'));
    }
}

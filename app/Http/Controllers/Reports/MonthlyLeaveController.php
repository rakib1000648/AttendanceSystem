<?php

namespace App\Http\Controllers\Reports;

use Illuminate\Http\Request;
use App\Http\Traits\DateRangeTrait;
use App\Http\Controllers\Controller;

class MonthlyLeaveController extends Controller
{
    use DateRangeTrait;

    public function index()
    {
        $year = $this->yearRange();
        $month = $this->monthRange();
        
       return view('layouts.reports.monthly_leave',compact('year','month'));
    }
}

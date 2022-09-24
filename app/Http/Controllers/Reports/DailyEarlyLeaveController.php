<?php

namespace App\Http\Controllers\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DailyEarlyLeaveController extends Controller
{
    public function index()
    {        
       return view('layouts.reports.daily_early_leave');
    }
}

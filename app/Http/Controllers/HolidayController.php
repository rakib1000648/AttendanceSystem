<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use DateTime;
use App\Models\Holiday;
use App\Models\HolidayChild;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HolidayController extends Controller
{
    public function index()
    {
        $no = 1;
        $data = DB::table('holidays as h')
            ->join('branches as b', 'h.branch_id', '=', 'b.id')
            ->select('h.*', 'branch_name','branch_location')
            ->orderByDesc('id')
            ->get();
        return view('layouts.employee.holiday',compact('data','no'));
    }

    public function createHoliday()
    {
        $branch = Branch::get();
        return view('layouts.employee.create-holiday',compact('branch'));
    }

    public function addHoliday(Request $request)
    {
       $validateData = $request->validate([
            'branch_id' => 'required',
            'holiday_name' => 'required|unique:holidays,holiday_name',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
       ]);

       Holiday::create($validateData);

       return redirect('holidays');
    }

    public function editHoliday($id)
    {
        $data = Holiday::where('id',$id)->first();
        $branch = Branch::get();
        return view('layouts.employee.edit-holiday',compact('data','branch'));
    }

    public function updateHoliday(Request $request)
    {
       $validateData = $request->validate([
            'branch_id' => 'required',
            'holiday_name' => 'required|unique:holidays,holiday_name,'.$request->id,
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
       ]);

       Holiday::where('id',$request->id)->update($validateData);
       return redirect('holidays');
    }

    public function deleteHoliday($id)
    {
        Holiday::where('id',$id)->delete();
        return redirect('holidays');
    }
}

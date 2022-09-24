<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    public function index()
    {
        $no = 1;
        $data = Shift::get();
        return view('layouts.company.shift',compact('data','no'));
    }

    public function createShift()
    {
        return view('layouts.company.create-shift');
    }

    public function addShift(Request $request)
    {
       $validateData = $request->validate([
            'shift_name' => 'required|string|unique:shifts,shift_name',
            'type' => 'required',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'grace_time' => 'nullable|date_format:H:i',
            'absent_time' => 'nullable|date_format:H:i',

       ]);

       Shift::create($validateData);
       return redirect('shifts');
    }

    public function editShift($id)
    {
        $data = Shift::where('id',$id)->first();
        return view('layouts.company.edit-shift',compact('data'));
    }

    public function updateShift(Request $request)
    {
        $validateData = $request->validate([
            'shift_name' => 'required|string|unique:shifts,shift_name,'.$request->id,
            'type' => 'required',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'grace_time' => 'nullable|date_format:H:i',
            'absent_time' => 'nullable|date_format:H:i',

       ]);

       Shift::where('id',$request->id)->update($validateData);
       return redirect('shifts');
    }
}

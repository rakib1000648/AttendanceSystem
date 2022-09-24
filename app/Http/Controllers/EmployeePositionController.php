<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeePosition;

class EmployeePositionController extends Controller
{
    public function index()
    {
        $no = 1;
        $data = EmployeePosition::get();
        return view('layouts.employee.employee-position',compact('data','no'));
    }

    public function createEmployeePosition()
    {
        return view('layouts.employee.create-employee-position');
    }

    public function addEmployeePosition(Request $request)
    {
       $validateData = $request->validate([
            'position_name' => 'required|max:40',
       ]);

       EmployeePosition::create($validateData);
       return redirect('employee-positions');
    }

    public function editEmployeePosition($id)
    {
        $data = EmployeePosition::where('id',$id)->first();
        return view('layouts.employee.edit-employee-position',compact('data'));
    }

    public function updateEmployeePosition(Request $request)
    {
       $validateData = $request->validate([
            'position_name' => 'required|max:40',
       ]);

       EmployeePosition::where('id',$request->id)->update($validateData);
       return redirect('employee-positions');
    }

    public function deleteEmployeePosition($id)
    {
        EmployeePosition::where('id',$id)->delete();
        return redirect('employee-positions');
    }
}

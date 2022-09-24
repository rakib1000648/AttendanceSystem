<?php

namespace App\Http\Controllers;

use App\Models\EmployeeType;
use Illuminate\Http\Request;

class EmployeeTypeController extends Controller
{
    public function index()
    {
        $no = 1;
        $data = EmployeeType::get();
        return view('layouts.employee.employee-type',compact('data','no'));
    }

    public function createEmployeeType()
    {
        return view('layouts.employee.create-employee-type');
    }

    public function addEmployeeType(Request $request)
    {
       $validateData = $request->validate([
            'type' => 'required|max:40',
       ]);

       EmployeeType::create($validateData);
       return redirect('employee-types');
    }

    public function editEmployeeType($id)
    {
        $data = EmployeeType::where('id',$id)->first();
        return view('layouts.employee.edit-employee-type',compact('data'));
    }

    public function updateEmployeeType(Request $request)
    {
       $validateData = $request->validate([
            'type' => 'required|max:40',
       ]);

       EmployeeType::where('id',$request->id)->update($validateData);
       return redirect('employee-types');
    }

    public function deleteEmployeeType($id)
    {
        EmployeeType::where('id',$id)->delete();
        return redirect('employee-types');
    }
}

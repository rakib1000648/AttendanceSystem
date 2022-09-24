<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $no = 1;
        $data = Department::get();
        return view('layouts.company.department',compact('data','no'));
    }

    public function createDepartment()
    {
        return view('layouts.company.create-department');
    }

    public function addDepartment(Request $request)
    {
       $validateData = $request->validate([
            'department_name' => 'required|max:30',
            'status' => 'numeric'
       ]);

       Department::create($validateData);
       return redirect('departments');
    }

    public function editDepartment($id)
    {
        $data = Department::where('id',$id)->first();
        return view('layouts.company.edit-department',compact('data'));
    }

    public function updateDepartment(Request $request)
    {
       $validateData = $request->validate([
            'department_name' => 'required|max:30',
            'status' => 'numeric'
       ]);

       Department::where('id',$request->id)->update($validateData);
       return redirect('departments');
    }
}

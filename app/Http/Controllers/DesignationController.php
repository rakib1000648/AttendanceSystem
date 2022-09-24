<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
{

    public function index()
    {
        $no = 1;
        $data = Designation::get();
        return view('layouts.employee.designation',compact('data','no'));
    }

    public function createDesignation()
    {
        return view('layouts.employee.create-designation');
    }

    public function addDesignation(Request $request)
    {
       $validateData = $request->validate([
            'designation' => 'required|max:30',
            'status' => 'numeric'
       ]);

       Designation::create($validateData);
       return redirect('designations');
    }

    public function editDesignation($id)
    {
        $data = Designation::where('id',$id)->first();
        return view('layouts.employee.edit-designation',compact('data'));
    }

    public function updateDesignation(Request $request)
    {
       $validateData = $request->validate([
            'designation' => 'required|max:30',
            'status' => 'numeric'
       ]);

       Designation::where('id',$request->id)->update($validateData);
       return redirect('designations');
    }
}

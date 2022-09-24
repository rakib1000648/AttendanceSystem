<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\DepartmentSection;
use Illuminate\Support\Facades\DB;

class DepartmentSectionController extends Controller
{
    public function index()
    {
        $no = 1;
        $data = DB::table('department_sections')
        ->leftJoin('departments', 'department_sections.dept_id','=','departments.id')
        ->select('department_sections.*','departments.department_name','departments.status')
        ->get();

        return view('layouts.company.department-section',compact('data','no'));
    }

    public function createDepartmentSection()
    {
        $data = Department::get();
        return view('layouts.company.create-department-section',compact('data'));
    }

    public function addDepartmentSection(Request $request)
    {
       $validateData = $request->validate([
            'section_name' => 'required|max:40',
            'dept_id' => 'required|numeric'
       ],
        [],['dept_id' => 'department']);

       DepartmentSection::create($validateData);
       return redirect('department-sections');
    }

    public function editDepartmentSection($id)
    {
        $Department = Department::get();
        $DepartmentSection = DepartmentSection::where('id',$id)->first();
        return view('layouts.company.edit-department-section',compact('Department','DepartmentSection'));
    }

    public function updateDepartmentSection(Request $request)
    {
        $validateData = $request->validate([
            'section_name' => 'required|max:40',
            'dept_id' => 'required|numeric'
       ],
        [],['dept_id' => 'department']);
       //dd($request->all());
       DepartmentSection::where('id',$request->id)->update($validateData);
       return redirect('department-sections');
    }
}

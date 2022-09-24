<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{

    public function index()
    {
        $no = 1;
        $data = Branch::get();
        return view('layouts.company.branch',compact('data','no'));
    }

    public function createBranch()
    {
        return view('layouts.company.create-branch');
    }

    public function addBranch(Request $request)
    {
       $validateData = $request->validate([
            'branch_name' => 'required',
            'branch_location' => 'required',
       ]);

       Branch::create($validateData);
       return redirect('branches');
    }

    public function editBranch($id)
    {
        $data = Branch::where('id',$id)->first();
        return view('layouts.company.edit-branch',compact('data'));
    }

    public function updateBranch(Request $request)
    {
       $validateData = $request->validate([
        'branch_name' => 'required',
        'branch_location' => 'required',
       ]);

       Branch::where('id',$request->id)->update($validateData);
       return redirect('branches');
    }
}

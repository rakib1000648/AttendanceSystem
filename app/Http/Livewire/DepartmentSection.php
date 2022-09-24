<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Department;
use App\Models\DepartmentSection as Section;

class DepartmentSection extends Component
{
    public $task;
    public $department_id;

    public $EmployeeDpId;
    public $dept_section_id;
    public $selected = true;


    public function render()
    {
        if ($this->task == 'create') {
            $Department = Department::get();
            $section = Section::Where('dept_id', $this->department_id)->get();
            return view('livewire.department-section',compact('Department','section'));
        }

        if ($this->task == 'edit') {
            $section = Section::Where('dept_id', $this->EmployeeDpId)->get();
            $Department = Department::get();

            return view('livewire.department-section',compact('Department','section'));
        }

    }
    public function changeEvent($value)
    {
        $this->EmployeeDpId = $value;
        $this->selected = false;
    }



}

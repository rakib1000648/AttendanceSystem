<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'employees';
    protected $fillable = [
        'user_id',
        'dev_emp_id',
        'phone',
        'father_name',
        'mother_name',
        'nationality',
        'nid',
        'birth_certificate',
        'blood_group',
        'religion',
        'gender',
        'marital_status',
        'present_address',
        'permanent_address',
        'dob',
        'employee_type_id',
        'branch_id',
        'shift_id',
        'designation_id',
        'department_id',
        'dept_section_id',
        'position_id',
        'employee_prefix_id',
        'joining_date',
        'joining_salary',
        'current_salary',
        'emergency_contact_name',
        'emergency_contact_relation',
        'emergency_contact_phone',
        'employee_image',
        'nid_file',
        'birth_file'
    ];
}

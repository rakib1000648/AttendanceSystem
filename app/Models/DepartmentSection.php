<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentSection extends Model
{
    use HasFactory;
    protected $table = 'department_sections';
    protected $fillable = ['section_name','dept_id'];
}

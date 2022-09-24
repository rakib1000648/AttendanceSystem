<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeLeave extends Model
{
    use HasFactory;
    protected $table = 'employee_leaves';
    protected $fillable = [
        'user_id',
        'leave_type_id',
        'leave_start_date',
        'leave_end_date',
        'leave_cause',
        'approval_status',
        'approver_id',
    ];
}

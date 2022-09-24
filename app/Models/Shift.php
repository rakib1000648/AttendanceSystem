<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;
    protected $table = 'shifts';
    protected $fillable = [
        'shift_name',
        'type',
        'start_time',
        'end_time',
        'grace_time',
        'absent_time'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HolidayChild extends Model
{
    use HasFactory;
    protected $table = 'holiday_children';
    protected $fillable = [
        'h_date',
        'holiday_id',
    ];
}

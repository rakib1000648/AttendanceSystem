<?php

namespace Database\Seeders;

use App\Models\EmployeeLeaveType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeaveTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'Annual',
            'Casual',
            'Sick'
        ];

        foreach ($types as $type) {
            EmployeeLeaveType::create(['type' => $type]);
        }

    }
}

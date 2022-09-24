<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('dev_emp_id')->nullable();
            $table->string('phone')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('nationality')->nullable();
            $table->string('nid')->nullable();
            $table->string('birth_certificate')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('religion')->nullable();
            $table->string('gender')->nullable();
            $table->string('marital_status')->nullable();
            $table->text('present_address')->nullable();
            $table->text('permanent_address')->nullable();
            $table->date('dob')->nullable();
            $table->integer('employee_type_id')->nullable();
            $table->integer('position_id')->nullable();
            $table->integer('branch_id')->nullable();
            $table->integer('designation_id')->nullable();
            $table->integer('department_id')->nullable();
            $table->integer('dept_section_id')->nullable();
            $table->integer('shift_id')->nullable();
            $table->string('employee_prefix_id')->nullable();
            $table->date('joining_date')->nullable();
            $table->double('joining_salary',8,2)->nullable();
            $table->double('current_salary',8,2)->nullable();
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_relation')->nullable();
            $table->string('emergency_contact_phone')->nullable();
            $table->string('employee_image')->nullable();
            $table->string('nid_file')->nullable();
            $table->string('birth_file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
};

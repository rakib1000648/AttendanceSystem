@extends('layouts.master_admin')

@section('content')
    <section class="main_content dashboard_part large_header_bg">
        <!-- menu  -->
        @include('layouts.admin.partials.header')
        <!--/ menu  -->

        <div class="main_content_iner ">
            <div class="container-fluid p-0">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="container rounded bg-white mt-2 mb-5">



                            <div class="row">

                                <div class="col-md-11 mx-auto">
                                    <div class="row">
                                        <div class="col-md">
                                            <a href="{{ url('edit-employee/'.$EmployeeData->id) }}"
                                                class="btn_6 btn-sm float-right mt-3 mx-2" role="button"><i
                                                    class="fas fa-edit f_s_14 mr-1"></i>EDIT</a>

                                            {{-- <button class="btn_6 btn-sm float-right mt-3">Print</button> --}}
                                        </div>

                                    </div>
                                    <div class="p-3">
                                        <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                                                @if ($EmployeeData->employee_image)
                                                <img class="rounded-circle mt-2 mb-2" height="150px" width="150px"
                                                src="{{ url('storage') }}/img/employee/{{ $EmployeeData->employee_image }}">
                                                @else
                                                <img class="rounded-circle mt-2 mb-2" height="170px" width="150px"
                                                src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                                                @endif
                                                <h4>{{ $EmployeeData->employee_name }}</h4>
                                                <span class="text-black-50"><i class="fas fa-envelope"></i> {{ $EmployeeData->email }}</span><span> </span>
                                                <span class="text-black-50"><i class="fas fa-phone"></i> {{ $EmployeeData->phone }}</span><span> </span>
                                        </div>

                                        <br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <article>
                                                        <h4>
                                                            <strong>Personal Details</strong>
                                                        </h4>
                                                        <hr>
                                                        <dl class="dl-horizontal">
                                                            <dt>Date of Birth:</dt>
                                                            <dd>{{ \Carbon\Carbon::parse($EmployeeData->dob)->format('d/m/Y')}}</dd>

                                                            <dt>Blood Group:</dt>
                                                            <dd>{{ $EmployeeData->blood_group }}</dd>

                                                            <dt>Country:</dt>
                                                            <dd>{{ $EmployeeData->country_name }}</dd>

                                                            <dt>National ID:</dt>
                                                            <dd>{{ $EmployeeData->nid }} &nbsp; @if ($EmployeeData->nid)
                                                                <a href="{{ url('download-nid') }}/{{ $EmployeeData->user_id }}" class="btn alert-info btn-sm px-3"><i class="fas fa-file-download"></i></a>
                                                            @endif</dd>

                                                            <dt>Birth Certificate No:</dt>
                                                            <dd>{{ $EmployeeData->birth_certificate }} @if ($EmployeeData->birth_certificate)
                                                                <a href="{{ url('download-bc') }}/{{ $EmployeeData->user_id }}" class="btn alert-info btn-sm px-3"><i class="fas fa-file-download"></i></a>
                                                                @endif</dd>

                                                            <dt>Religion:</dt>
                                                            <dd>{{ $EmployeeData->religion }}</dd>

                                                            <dt>Gender:</dt>
                                                            <dd>{{ $EmployeeData->gender }}</dd>

                                                            <dt>Marital Status:</dt>
                                                            <dd>{{ $EmployeeData->marital_status }}</dd>

                                                            <dt>Father Name:</dt>
                                                            <dd>{{ $EmployeeData->father_name }}</dd>

                                                            <dt>Mother Name:</dt>
                                                            <dd>{{ $EmployeeData->mother_name }}</dd>

                                                            <dt>Emergency Contact Person:</dt>
                                                            <dd>{{ $EmployeeData->emergency_contact_name }}</dd>

                                                            <dt>Emergency Contact Relation:</dt>
                                                            <dd>{{ $EmployeeData->emergency_contact_relation }}</dd>

                                                            <dt>Emergency Contact Phone:</dt>
                                                            <dd>{{ $EmployeeData->emergency_contact_phone }}</dd>
                                                        </dl>
                                                    </article>

                                                </div>

                                                <div class="col-md-6">
                                                    <article>
                                                        <h4>
                                                            <strong>Employment Details</strong>
                                                        </h4>
                                                        <hr>
                                                        <dl class="dl-horizontal">
                                                            <dt>Employee Type:</dt>
                                                            <dd>{{ $EmployeeData->type }}</dd>

                                                            <dt>Employee Position:</dt>
                                                            <dd>{{ $EmployeeData->position_name }}</dd>

                                                            <dt>Designation:</dt>
                                                            <dd>{{ $EmployeeData->designation }}</dd>

                                                            <dt>Dedepartment:</dt>
                                                            <dd>{{ $EmployeeData->department_name }} - {{ $EmployeeData->section_name }}</dd>

                                                            <dt>Branch:</dt>
                                                            <dd>{{ $EmployeeData->branch_name }}</dd>

                                                            <dt>Shift:</dt>
                                                            <dd>{{ $EmployeeData->shift_name }}</dd>

                                                            <dt>Employee Company prefix:</dt>
                                                            <dd>{{ $EmployeeData->employee_prefix_id }}</dd>

                                                            <dt>Current Salary:</dt>
                                                            <dd>{{ $EmployeeData->current_salary }}</dd>

                                                            <dt>Joining Date:</dt>
                                                            <dd>{{ $EmployeeData->joining_date }}</dd>

                                                            <dt>Joining Salary:</dt>
                                                            <dd>{{ $EmployeeData->joining_salary }}</dd>

                                                        </dl>
                                                    </article>

                                                    <article>
                                                        <h4>
                                                            <strong>Address</strong>
                                                        </h4>
                                                        <hr>
                                                        <dl class="dl-horizontal">
                                                            <dt>Present Address:</dt>
                                                            <dd>{{ $EmployeeData->present_address }}</dd>

                                                            <dt>Permanent Address:</dt>
                                                            <dd>{{ $EmployeeData->permanent_address }}</dd>
                                                        </dl>
                                                    </article>
                                                </div>
                                            </div>


                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-12">

                    </div>
                </div>
            </div>
        </div>

        <!-- footer part -->
        @include('layouts.admin.partials.footer')
    </section>
@endsection

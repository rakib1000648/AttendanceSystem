@extends('layouts.master_admin')

@section('content')
    <section class="main_content dashboard_part large_header_bg">
        <!-- menu  -->
        @include('layouts.admin.partials.header')
        <!--/ menu  -->

        <div class="main_content_iner ">
            <div class="container-fluid p-0">
                <div class="row justify-content-center">

                    <div class="col-lg-10 mt-5">
                        <div class="white_card card_height_100 mb_30">
                            <div class="white_card_header bg-light mb-2">
                                <div class="box_header m-0">
                                    <div class="main-title">
                                        <h3 class="m-0">Edit Employee Data</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="white_card_body">

                                <form action="{{ url('edit-employee') }}" method="POST" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <input type="text" name="user_id" value="{{ $EmployeeData->user_id }}" hidden>
                                    <input type="text" name="id" value="{{ $EmployeeData->id }}" hidden>

                                    <div class="form-row">
                                        <div class="form-group col-md-5">
                                            <label for="name">Employee Name :<span
                                                    class="text-danger"><b>❋</b></span></label>
                                            <input type="text" class="form-control" value="{{ $EmployeeData->name }}"
                                                name="name" id="name" placeholder="Enter name...">
                                            @if ($errors->has('name'))
                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>

                                        <div class="form-group col-md-5">
                                            <label for="roles">Select Role :<span class="text-danger"><b>❋</b></label>
                                            <select id="roles" class="form-control" name="roles">
                                                <option value="">Choose...</option>
                                                @foreach ($Role as $d)
                                                    <option value="{{ $d->id }}"
                                                        @if ($Role_id == $d->id) Selected @endif>
                                                        {{ $d->name }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('roles'))
                                                <span class="text-danger">{{ $errors->first('roles') }}</span>
                                            @endif
                                        </div>

                                        {{-- <div class="form-group col-md-2">
                                            <label for="dev_emp_id">Device User Id:</label>
                                            <select id="dev_emp_id" class="form-control" name="dev_emp_id">
                                                <option value="">Choose...</option>
                                                @foreach ($DeviceUID as $d)
                                                    <option value="{{ $d }}"
                                                        @if ($EmployeeData->dev_emp_id == $d) Selected @endif>
                                                        {{ $d }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('dev_emp_id'))
                                                <span class="text-danger">{{ $errors->first('dev_emp_id') }}</span>
                                            @endif
                                        </div> --}}

                                        <div class="form-group col-md-2">
                                            <label for="dev_emp_id">Device User Id:</label>
                                            <input type="text" class="form-control" value="{{ $EmployeeData->dev_emp_id }}" name="dev_emp_id" id="dev_emp_id" placeholder="Enter employee id...">
                                            @if ($errors->has('dev_emp_id'))
                                            <span class="text-danger">{{ $errors->first('dev_emp_id') }}</span>
                                            @endif
                                        </div>

                                    </div>


                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="email">Email Address:<span
                                                    class="text-danger"><b>❋</b></span></label>
                                            <input type="email" class="form-control" value="{{ $EmployeeData->email }}"
                                                name="email" id="email" placeholder="Enter email address...">
                                            @if ($errors->has('email'))
                                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="phone">Phone Number :<span
                                                    class="text-danger"><b>❋</b></span></label>
                                            <input type="text" class="form-control" value="{{ $EmployeeData->phone }}"
                                                name="phone" id="phone" placeholder="Enter phone number...">
                                            @if ($errors->has('phone'))
                                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="password">Password :</label>
                                            <input type="password" class="form-control" name="password" id="password"
                                                placeholder="Enter password...">
                                            @if ($errors->has('password'))
                                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="password-confirm">Confirm Password :</label>
                                            <input type="password" class="form-control" name="password-confirm"
                                                id="password-confirm" placeholder="Enter password-confirm...">
                                            @if ($errors->has('password-confirm'))
                                                <span
                                                    class="text-danger">{{ $errors->first('password-confirm') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="branch_id">Select Branch :<span
                                                    class="text-danger"><b>❋</b></span></label>
                                            <select id="branch_id" class="form-control" name="branch_id">
                                                @foreach ($Branch as $d)
                                                    <option value="{{ $d->id }}"
                                                        @if ($EmployeeData->branch_id == $d->id) Selected @endif>
                                                        {{ $d->branch_name }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('branch_id'))
                                                <span class="text-danger">{{ $errors->first('branch_id') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="shift_id">Select Shift :<span
                                                    class="text-danger"><b>❋</b></span></label>
                                            <select id="shift_id" class="form-control" name="shift_id">

                                                @foreach ($Shift as $d)
                                                    <option value="{{ $d->id }}"
                                                        @if ($EmployeeData->shift_id == $d->id) Selected @endif>
                                                        {{ $d->shift_name }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('shift_id'))
                                                <span class="text-danger">{{ $errors->first('shift_id') }}</span>
                                            @endif
                                        </div>

                                    </div>


                                    @livewire('department-section', ['task' => 'edit','EmployeeDpId' =>
                                    $EmployeeData->department_id, 'dept_section_id' => $EmployeeData->dept_section_id])


                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="designation_id">Select Designation :<span
                                                    class="text-danger"><b>❋</b></span></label>
                                            <select id="designation_id" class="form-control" name="designation_id">

                                                @foreach ($Designation as $d)
                                                    <option value="{{ $d->id }}"
                                                        @if ($EmployeeData->designation_id == $d->id) Selected @endif>
                                                        {{ $d->designation }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('designation_id'))
                                                <span
                                                    class="text-danger">{{ $errors->first('designation_id') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="employee_type">Employee Type:</label>
                                            <select id="employee_type" class="form-control" name="employee_type_id">
                                                <option value="">Choose...</option>
                                                @foreach ($EmployeeType as $d)
                                                    <option value="{{ $d->id }}"
                                                        @if ($EmployeeData->employee_type_id == $d->id) Selected @endif>
                                                        {{ $d->type }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('employee_type_id'))
                                                <span
                                                    class="text-danger">{{ $errors->first('employee_type_id') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="father_name">Father Name :</label>
                                            <input type="text" class="form-control"
                                                value="{{ $EmployeeData->father_name }}" name="father_name"
                                                id="father_name" placeholder="Enter father name...">
                                            @if ($errors->has('father_name'))
                                                <span class="text-danger">{{ $errors->first('father_name') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="mother_name">Mother Name :</label>
                                            <input type="text" class="form-control"
                                                value="{{ $EmployeeData->mother_name }}" name="mother_name"
                                                id="mother_name" placeholder="Enter mother name...">
                                            @if ($errors->has('mother_name'))
                                                <span class="text-danger">{{ $errors->first('mother_name') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="nationality">Nationality :</label>
                                            <select id="nationality" class="form-control" name="nationality">
                                                @foreach ($Country as $d)
                                                    <option value="{{ $d->id }}"
                                                        @if ($EmployeeData->nationality == $d->id) Selected @endif>
                                                        {{ $d->name }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('nationality'))
                                                <span class="text-danger">{{ $errors->first('nationality') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="nid">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="is_nid"
                                                        id="inlineRadio1" value="nid"
                                                        @if ($card == 'nidCard') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio1">NID</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="is_nid"
                                                        id="inlineRadio2" value="bc"
                                                        @if ($card == 'bcCard') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio2">Birth
                                                        Certificate</label>
                                                </div>
                                              
                                            </label>

                                            <input type="text" class="form-control"
                                                @if ($card == 'nidCard') value="{{ $EmployeeData->nid }}"
                                    @elseif ($card == 'bcCard')
                                    value="{{ $EmployeeData->birth_certificate }}" @endif
                                                name="nid" id="nid" placeholder="Enter nid number...">

                                            @if ($errors->has('nid'))
                                                <span class="text-danger">{{ $errors->first('nid') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="blood_group">Blood Group:</label>
                                            <select id="blood_group" class="form-control" name="blood_group">
                                                <option value="">Choose...</option>
                                                <option value="A+" @if ($EmployeeData->blood_group == 'A+') Selected @endif>A+
                                                </option>
                                                <option value="A-" @if ($EmployeeData->blood_group == 'A-') Selected @endif>A-
                                                </option>
                                                <option value="B+" @if ($EmployeeData->blood_group == 'B+') Selected @endif>B+
                                                </option>
                                                <option value="B-" @if ($EmployeeData->blood_group == 'B-') Selected @endif>B-
                                                </option>
                                                <option value="AB+" @if ($EmployeeData->blood_group == 'AB+') Selected @endif>AB+
                                                </option>
                                                <option value="AB-" @if ($EmployeeData->blood_group == 'AB-') Selected @endif>AB-
                                                </option>
                                                <option value="O+" @if ($EmployeeData->blood_group == 'O+') Selected @endif>O+
                                                </option>
                                                <option value="O-" @if ($EmployeeData->blood_group == 'O-') Selected @endif>O-
                                                </option>
                                                <option value="Unknown" @if ($EmployeeData->blood_group == 'Unknown') Selected @endif>
                                                    Unknown</option>
                                            </select>
                                            @if ($errors->has('blood_group'))
                                                <span class="text-danger">{{ $errors->first('blood_group') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="religion">Religion:</label>
                                            <input type="text" class="form-control"
                                                value="{{ $EmployeeData->religion }}" name="religion" id="religion"
                                                placeholder="Enter religion...">
                                            @if ($errors->has('religion'))
                                                <span class="text-danger">{{ $errors->first('religion') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="gender">Gender :</label>
                                            <select id="gender" class="form-control" name="gender">
                                                <option value="">Choose...</option>
                                                <option value="Male" @if ($EmployeeData->gender == 'Male') Selected @endif>
                                                    Male</option>
                                                <option value="Female" @if ($EmployeeData->gender == 'Female') Selected @endif>
                                                    Female</option>
                                                <option value="Other" @if ($EmployeeData->gender == 'Other') Selected @endif>
                                                    Other</option>
                                            </select>
                                            @if ($errors->has('gender'))
                                                <span class="text-danger">{{ $errors->first('gender') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="marital_status">Marital Status:</label>
                                            <select id="marital_status" class="form-control" name="marital_status">
                                                <option value="">Choose...</option>
                                                <option value="Signle" @if ($EmployeeData->marital_status == 'Signle') Selected @endif>
                                                    Signle</option>
                                                <option value="Married" @if ($EmployeeData->marital_status == 'Married') Selected @endif>
                                                    Married</option>
                                                <option value="Widowed" @if ($EmployeeData->marital_status == 'Widowed') Selected @endif>
                                                    Widowed</option>
                                                <option value="Divorced"
                                                    @if ($EmployeeData->marital_status == 'Divorced') Selected @endif>Divorced</option>
                                            </select>
                                            @if ($errors->has('marital_status'))
                                                <span
                                                    class="text-danger">{{ $errors->first('marital_status') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="present_address">Present Address:</label>
                                            <textarea name="present_address" class="form-control" id="present_address" cols="30" rows="2"
                                                placeholder="Enter present address...">{{ $EmployeeData->present_address }}</textarea>
                                            @if ($errors->has('present_address'))
                                                <span
                                                    class="text-danger">{{ $errors->first('present_address') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="Tpermanent_addressype">Permanent Address:</label>
                                            <textarea name="permanent_address" class="form-control" id="permanent_address" cols="30" rows="2"
                                                placeholder="Enter permanent address...">{{ $EmployeeData->permanent_address }}</textarea>
                                            @if ($errors->has('permanent_address'))
                                                <span
                                                    class="text-danger">{{ $errors->first('permanent_address') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="dob">Date of birth :</label>
                                            <input type="date" class="form-control" value="{{ $EmployeeData->dob }}"
                                                name="dob" id="dob">
                                            @if ($errors->has('dob'))
                                                <span class="text-danger">{{ $errors->first('dob') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="employee_position">Employee Position:</label>
                                            <select id="employee_position" class="form-control" name="position_id">
                                                <option value="">Choose...</option>
                                                @foreach ($EmployeePosition as $d)
                                                    <option value="{{ $d->id }}"
                                                        @if ($EmployeeData->position_id == $d->id) Selected @endif>
                                                        {{ $d->position_name }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('position_id'))
                                                <span class="text-danger">{{ $errors->first('position_id') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="employee_prefix_id">Employee id:</label>
                                            <input type="text" class="form-control"
                                                value="{{ $EmployeeData->employee_prefix_id }}" name="employee_prefix_id"
                                                id="employee_prefix_id" placeholder="Enter employee id...">
                                            @if ($errors->has('employee_prefix_id'))
                                                <span
                                                    class="text-danger">{{ $errors->first('employee_prefix_id') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="joining_date">Joining Date :</label>
                                            <input type="date" class="form-control"
                                                value="{{ $EmployeeData->joining_date }}" name="joining_date"
                                                id="joining_date">
                                            @if ($errors->has('joining_date'))
                                                <span class="text-danger">{{ $errors->first('joining_date') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="joining_salary">Joining Salary :</label>
                                            <input type="number" class="form-control"
                                                value="{{ $EmployeeData->joining_salary }}" name="joining_salary"
                                                id="joining_salary" placeholder="Enter joining salary...">
                                            @if ($errors->has('joining_salary'))
                                                <span
                                                    class="text-danger">{{ $errors->first('joining_salary') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="current_salary">Current Salary :</label>
                                            <input type="number" class="form-control"
                                                value="{{ $EmployeeData->current_salary }}" name="current_salary"
                                                id="current_salary" placeholder="Enter current salary...">
                                            @if ($errors->has('current_salary'))
                                                <span
                                                    class="text-danger">{{ $errors->first('current_salary') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="emergency_contact_name">Emergency contact Name :</label>
                                            <input type="text" class="form-control"
                                                value="{{ $EmployeeData->emergency_contact_name }}"
                                                name="emergency_contact_name" id="emergency_contact_name"
                                                placeholder="Enter emergency contact name...">
                                            @if ($errors->has('emergency_contact_name'))
                                                <span
                                                    class="text-danger">{{ $errors->first('emergency_contact_name') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="emergency_contact_relation">Emergency Contact Relation :</label>
                                            <input type="text" class="form-control"
                                                value="{{ $EmployeeData->emergency_contact_relation }}"
                                                name="emergency_contact_relation" id="emergency_contact_relation"
                                                placeholder="Enter emergency contact relation...">
                                            @if ($errors->has('emergency_contact_relation'))
                                                <span
                                                    class="text-danger">{{ $errors->first('emergency_contact_relation') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="emergency_contact_phone">Emergency Contact Phone :</label>
                                            <input type="text" class="form-control"
                                                value="{{ $EmployeeData->emergency_contact_phone }}"
                                                name="emergency_contact_phone" id="emergency_contact_phone"
                                                placeholder="Enter emergency contact phone...">
                                            @if ($errors->has('emergency_contact_phone'))
                                                <span
                                                    class="text-danger">{{ $errors->first('emergency_contact_phone') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-row">

                                        <div class="form-group col-md-6">
                                            <input type="text" value="{{ $EmployeeData->employee_image }}"
                                                name="filename" hidden>
                                            <label for="employee_image">Upload Employee Photo :</label>
                                            <input type="file" class="form-control-file" id="employee_image"
                                                name="employee_image">
                                            @if ($errors->has('employee_image'))
                                                <span
                                                    class="text-danger">{{ $errors->first('employee_image') }}</span>
                                            @endif
                                        </div>

                                        <div class="form-group col-md-6">
                                            <input type="text" value="{{ $EmployeeData->nid_file }}" name="nid_filename"
                                                hidden>
                                            <input type="text" value="{{ $EmployeeData->birth_file }}" name="bc_filename"
                                                hidden>
                                            <label for="nid_file">Upload Nid/Birth Cerficate File :</label>
                                            <input type="file" class="form-control-file" id="nid_file" name="nid_file">
                                            @if ($errors->has('nid_file'))
                                                <span class="text-danger">{{ $errors->first('nid_file') }}</span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group mt-3 mb-0">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>

                                </form>


                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- footer part -->
        @include('layouts.admin.partials.footer')
    </section>
@endsection

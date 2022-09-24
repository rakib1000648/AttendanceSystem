@extends('layouts.master_admin')

@section('content')
    <section class="main_content dashboard_part large_header_bg">
        <!-- menu  -->
        @include('layouts.admin.partials.header')
        <!--/ menu  -->

        <div class="main_content_iner ">
            <div class="container-fluid p-0">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="white_card card_height_100 mb_30">
                            <div class="white_card_header">
                                <div class="box_header m-0">
                                    <div class="main-title">
                                        {{-- <h3 class="m-0">Employee Designations</h3> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="white_card_body">
                                <div class="QA_section">
                                    <div class="white_box_tittle list_header">
                                        <h4>Employees</h4>
                                        <div class="box_right d-flex lms_block">
                                            <div class="serach_field_2">

                                            </div>
                                            <div class="add_button ml-10">
                                                <a href="{{ url('create-employee') }}" class="btn_1 btn-sm">Add
                                                    New</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb_30 QA_table">
                                        <!-- table-responsive -->
                                        <table class="table lms_table_active table-striped">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Phone</th>
                                                    <th scope="col">Designation</th>
                                                    <th scope="col">Department</th>
                                                    <th scope="col">Device Linked Id</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($Employee as $d)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $d->name }}</td>
                                                    <td>{{ $d->phone }}</td>
                                                    <td>{{ $d->designation }}</td>
                                                    <td>{{ $d->department_name }}</td>
                                                    <td>{{ $d->dev_emp_id }}</td>
                                                    <td>
                                                        <a href="{{ url('view-employee/'.$d->id) }}"
                                                            class="btn btn-info btn-sm rounded-pill px-3"><i
                                                                class="fas fa-eye f_s_14 mr-1"></i>VIEW</a>

                                                        <a href="{{ url('edit-employee/'.$d->id) }}"
                                                            class="btn btn-primary btn-sm rounded-pill px-3"><i
                                                                class="fas fa-edit f_s_14 mr-1"></i>EDIT</a>

                                                    </td>
                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>

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

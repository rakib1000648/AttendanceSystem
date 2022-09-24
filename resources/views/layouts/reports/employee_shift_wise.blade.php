@extends('layouts.master_admin')

@section('content')
    <section class="main_content dashboard_part large_header_bg">
        <!-- menu  -->
        @include('layouts.admin.partials.header')
        <!--/ menu  -->
        <style>
            .customDays {
                max-height: 300px;
                overflow-y: auto;
            }

        </style>
        <div class="main_content_iner ">
            <div class="container-fluid p-0">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="white_card card_height_100 mb_30">
                            <div class="white_card_header">

                            </div>
                            <div class="white_card_body">
                                <div class="QA_section">
                                    <div class="white_box_tittle list_header">
                                        <h4 class="text-center">Employee Data Shift Wise</h4>
                                    </div>

                                    <div class="col-md-4 float-left">

                                        <a type="button" href="{{ url('employee-shift-wise/Day') }}" class="btn btn-outline-info btn-sm">Day</a>
                                        <a type="button"  href="{{ url('employee-shift-wise/Night') }}" class="btn btn-outline-info btn-sm">Night</a>
                                        <a href="" class="btn btn-outline-info btn-sm"><i class="fas fa-file-pdf"></i> PDF</a>
                                    </div>

                                    <div class="QA_table mb_30">
                                        <!-- table-responsive -->
                                        <div class="QA_table mb_30">
                                            <!-- table-responsive -->
                                            <table class="table lms_table_active ">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Photo</th>
                                                        <th scope="col">Employee</th>
                                                        <th scope="col">Designation</th>
                                                        <th scope="col">Shift</th>
                                                        <th scope="col">Type</th>
                                                        <th scope="col">Join Date</th>
                                                        <th scope="col">Branch</th>
                                                        <th scope="col">Address</th>
                                                        {{-- <th scope="col">DPRT</th> --}}
                                                        <th scope="col">BG</th>
                                                        <th scope="col">Gdr</th>
                                                        <th scope="col">MS</th>
                                                        <th scope="col">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($data as $item)
                                                    <tr>
                                                        @if($item->EmpPhoto)
                                                        <td scope="row"><a href="#" class=""><img src="{{ url('storage') }}/img/employee/{{ $item->EmpPhoto }}" width="40" height="40" alt="{{ $item->EmpName }}"></a></td>
                                                        @else
                                                            <td>No Photo</td>
                                                        @endif

                                                        <td>{{ $item->EmpName }}</td>
                                                        <td>{{ $item->EmpDesignation }}</td>
                                                        <td>{{ $item->EmpShift }}</td>
                                                        <td>{{ $item->EmpType }}</td>
                                                        <td>{{ $item->EmpJoining }}</td>
                                                        <td>{{ $item->EmpBranch }}</td>
                                                        <td>{{ $item->EmpAddress }}</td>
                                                        {{-- <td>{{ $item->EmpName }}</td> --}}
                                                        <td>{{ $item->EmpBloodGroup }}</td>
                                                        <td>{{ $item->EmpGender }}</td>
                                                        <td>{{ $item->EmpMaritalStatus }}</td>



                                                        <td>
                                                            <a href="#" class="btn btn-light btn-sm"><i class="fas fa-edit"></i></a>
                                                            <a href="#" class="btn btn-light btn-sm"><i class="fas fa-search-plus"></i></a>
                                                            <a href="#" class="btn btn-light btn-sm"><i class="fas fa-times" style="color: red"></i></a>
                                                        </td>
                                                    @endforeach

                                                    </tr>
                                                </tbody>
                                            </table>
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

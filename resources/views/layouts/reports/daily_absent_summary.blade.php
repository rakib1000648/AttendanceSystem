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
                                    <h4 class="text-center">Daily Absent Summary</h4>
                                </div>

                                <div class="col-md-12 float-left">

                                    <form action="{{ url('daily-absent-summary') }}" method="POST">
                                        @csrf
                                        <div class="form-row align-items-center">
                                            <div class="col-auto my-1">
                                                <input type="date" class="form-control-sm" name="fullDate" @if (isset($fullDate))
                                                value="{{ $fullDate }}"
                                                @else
                                                value="{{ Carbon\Carbon::now()->format('Y-m-d') }}"
                                                @endif >
                                            </div>


                                            <div class="col-auto my-1">
                                                <button type="submit" class="btn btn-primary btn-sm">Generate</button>
                                            </div>

                                            <div class="col-auto my-1">
                                                <label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Preference</label>
                                                <a href="daily-absent-summary-pdf" class="btn btn-outline-info btn-sm"><i class="fas fa-file-pdf"></i> PDF</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="QA_table mb_30">
                                    <!-- table-responsive -->
                                    <div class="QA_table mb_30">
                                        <!-- table-responsive -->
                                        <table class="table lms_table_active ">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Employee</th>
                                                    <th scope="col">Department</th>
                                                    <th scope="col">Designation</th>
                                                    <th scope="col">Shift</th>
                                                    <th scope="col">Office Start</th>
                                                    <th scope="col">Grace</th>
                                                    <th scope="col">Punched At</th>
                                                    <th scope="col">Marking</th>
                                                    {{-- <th scope="col">Actions</th> --}}
                                            </thead>
                                            <tbody>
                                                @foreach ($results as $key => $data)
                                                    
                                                @if ($data['marking']=='Absent')
                                                <tr>
                                                    <td>{{ $data['username'] }}</td>
                                                    <td>{{ $data['department_name'] }}</td>
                                                    <td>{{ $data['designation'] }}</td>
                                                    <td>{{ $data['shift_name'] }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($data['office_start'])->format('h:i a') }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($data['grace_time'])->format('h:i a') }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($data['first_punch'])->format('h:i:s a') }}</td>
                                                    <td><span class="status_btn bg-danger">{{ $data['marking'] }}</span></td>
                                                    {{-- <td>
                                                        <a href="#" class="btn btn-light btn-sm"><i class="fas fa-edit"></i></a>
                                                        <a href="#" class="btn btn-light btn-sm"><i class="fas fa-search-plus"></i></a>
                                                        <a href="#" class="btn btn-light btn-sm"><i class="fas fa-times" style="color: red"></i></a>
                                                    </td> --}}
                                                </tr>
                                                @endif
                                                   
                                                @endforeach


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
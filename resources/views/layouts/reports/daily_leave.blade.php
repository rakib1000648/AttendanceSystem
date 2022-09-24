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
                                    <h4 class="text-center">Daily Leave Report</h4>
                                </div>

                                <div class="col-md-12 float-left">

                                    <form action="{{ url('daily-leave') }}" method="POST">
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
                                                <a href="{{ url('daily-leave-pdf') }}" class="btn btn-outline-info btn-sm"><i class="fas fa-file-pdf"></i> PDF</a>
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
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Employee</th>
                                                    <th scope="col">Leave Duration</th>
                                                    <th scope="col">Type</th>
                                                    <th scope="col">Reason</th>
                                                    <th scope="col">Approved By</th>
                                                    {{-- <th scope="col">Actions</th> --}}
                                            </thead>
                                            <tbody>
                                                @foreach ($results as $key => $data)
                                                    
                                                <tr>
                                                    <td>{{Carbon\Carbon::parse($fullDate)->format('d/m/Y') }}</td>
                                                    <td>{{ $data->name }}</td>
                                                    <td>{{ Carbon\Carbon::parse($data->leave_start_date)->format('d/m/Y') }} - {{ Carbon\Carbon::parse($data->leave_end_date)->format('d/m/Y') }}</td>
                                                    <td>{{ $data->type }}</td>
                                                    <td>{{ $data->leave_cause }}</td>
                                                    <td>{{ $data->appr_name }}</td>
                                                    {{-- <td>
                                                        <a href="#" class="btn btn-light btn-sm"><i class="fas fa-edit"></i></a>
                                                        <a href="#" class="btn btn-light btn-sm"><i class="fas fa-search-plus"></i></a>
                                                        <a href="#" class="btn btn-light btn-sm"><i class="fas fa-times" style="color: red"></i></a>
                                                    </td> --}}
                                                </tr>
                                            
                                                   
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
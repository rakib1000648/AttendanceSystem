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
                                    <div class="col-md-2 float-left">

                                            <div class="dropdown">

                                                <a class="btn btn-outline-success btn-sm dropdown-toggle" href="#"
                                                    role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    Select Branch
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <a class="dropdown-item"
                                                    href="{{ url('leaves-yearly') }}/{{ '0' }}/{{ $year = Carbon\Carbon::now()->format('Y') }}">All</a>
                                                    @foreach ($branch as $d)
                                                        <a class="dropdown-item"
                                                            href="{{ url('leaves-yearly') }}/{{ $d->id }}/{{ $year = Carbon\Carbon::now()->format('Y') }}">{{ $d->branch_name }}</a>
                                                    @endforeach
                                                </div>
                                            </div>

                                    </div>
                                    <div class="col-md-10 float-left">


                                        <div class="dropdown">

                                            <a class="btn btn-outline-success btn-sm dropdown-toggle" href="#"
                                                role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                Select Year
                                            </a>

                                            <a href="{{ url('generate-leave-report-pdf') }}" role="button"
                                            class="btn btn-primary btn-sm mx-2">
                                            Download &nbsp;<i class="fas fa-file-download"></i>
                                            </a>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">

                                            @foreach ($period as $year)
                                            <a class="dropdown-item" href="{{ url('leaves-yearly') }}/{{ session()->get('branch_id_for_leave') }}/{{ $year->format('Y') }}">{{ $year->format('Y') }}</a>
                                            @endforeach

                                            </div>
                                        </div>


                                    </div>

                                </div>
                            </div>
                            <div class="white_card_body">
                                <div class="QA_section">
                                    <div class="white_box_tittle list_header">
                                        <h4>Employee Leaves Report</h4>
                                        <div class="box_right d-flex lms_block">
                                            <div class="serach_field_2">

                                            </div>

                                        </div>
                                    </div>

                                    <div class="QA_table mb_30">
                                        <!-- table-responsive -->
                                        <table class="table lms_table_active table-striped">
                                            <thead>
                                                <tr>
                                                    <th scope="col">S/N</th>
                                                    <th scope="col">Employee</th>
                                                    <th scope="col">Designation</th>
                                                    <th scope="col">Total</th>
                                                    <th scope="col">Annual</th>
                                                    <th scope="col">Sick</th>
                                                    <th scope="col">Casual</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($results as $item)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $item['name'] }}</td>
                                                    <td>{{ $item['designation'] }}</td>
                                                    <td class="text-warning"><strong>{{ $item['leave_total'] }} {{ 'days' }}</strong></td>
                                                    <td>{{ $item['annual_total'] }} {{ 'days' }}</td>
                                                    <td>{{ $item['casual_total'] }} {{ 'days' }}</td>
                                                    <td>{{ $item['sick_total'] }} {{ 'days' }}</td>
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

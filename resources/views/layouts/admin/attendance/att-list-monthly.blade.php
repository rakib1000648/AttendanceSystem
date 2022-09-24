@extends('layouts.master_admin')

@section('content')
    <section class="main_content dashboard_part large_header_bg">
        <!-- menu  -->
        @include('layouts.admin.partials.header')
        <!--/ menu  -->
        <style>
            table {
                width: 100%;
            }

            .tbl-header {
                text: black;
                background-color: white;
                padding-top: 20px;
                padding-bottom: 20px;
                margin-bottom: 5px;
                border-radius: 5px;
            }

            .table_main {
                text: black;
                background-color: white;
                padding-bottom: 20px;
                border-radius: 5px;
                overflow: auto;
            }

            table,
            th,
            td {
                font-size: small;
                border: 2px solid rgb(180, 176, 176);
                border-collapse: collapse;
            }

            #data .data_tr {
                display: none;
            }

            #nav a {
                margin-top: 10px;
                color: black;
                float: left;
                padding: 6px 12px;
                text-decoration: none;
            }

            #nav a.active {
                background-color: #3b176b;
                color: white;
                border-radius: 5px;
            }

            #nav a:hover:not(.active) {
                background-color: #ddd;
                border-radius: 5px;
            }

        </style>
        <div class="main_content_iner">

            <div class="col-md-12 tbl-header">
                <div class="mb-4">
                    <div class="col-md-1 col-lg-1 float-left">

                        <div class="dropdown">

                            <a class="btn btn-outline-success btn-sm dropdown-toggle" href="#" role="button" id="branch"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Branch
                            </a>
                            <div class="dropdown-menu" aria-labelledby="branch">
                                @foreach ($branch as $d)
                                    <a class="dropdown-item"
                                        href="{{ url('att-list-monthly') }}/{{ $d->id }}">{{ $d->branch_name }}</a>
                                @endforeach
                            </div>
                        </div>

                    </div>

                    <div class="col-md-1 col-lg-1 float-left">

                        <div class="dropdown">
                            <a class="btn btn-outline-success btn-sm dropdown-toggle" href="#" role="button" id="year"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @if (session()->get('year'))
                                    {{ session()->get('year') }}
                                @else
                                    {{ Carbon\Carbon::now()->year }}
                                @endif
                            </a>

                            <div class="dropdown-menu" aria-labelledby="year">

                                @foreach ($period as $year)
                                    <a class="dropdown-item"
                                        href="{{ url('att-list-monthly') }}/{{ session()->get('branch_id') }}/{{ $year->format('Y') }}">{{ $year->format('Y') }}</a>
                                @endforeach

                            </div>
                        </div>

                    </div>
                    <div class="col-md-1 col-lg-1 float-left">

                        <div class="dropdown">
                            <a class="btn btn-outline-success btn-sm dropdown-toggle" href="#" role="button" id="month"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @if (session()->get('month'))
                                    {{ Carbon\Carbon::parse('2022-' . session()->get('month') . '-05')->format('F') }}
                                @else
                                    {{ Carbon\Carbon::now()->format('F') }}
                                @endif
                            </a>

                            <div class="dropdown-menu" aria-labelledby="month">

                                <a class="dropdown-item"
                                    href="{{ url('att-list-monthly') }}/{{ session()->get('branch_id') }}/{{ session()->get('year') }}/{{ '01' }}">{{ 'January' }}</a>
                                <a class="dropdown-item"
                                    href="{{ url('att-list-monthly') }}/{{ session()->get('branch_id') }}/{{ session()->get('year') }}/{{ '02' }}">{{ 'February' }}</a>
                                <a class="dropdown-item"
                                    href="{{ url('att-list-monthly') }}/{{ session()->get('branch_id') }}/{{ session()->get('year') }}/{{ '03' }}">{{ 'March' }}</a>
                                <a class="dropdown-item"
                                    href="{{ url('att-list-monthly') }}/{{ session()->get('branch_id') }}/{{ session()->get('year') }}/{{ '04' }}">{{ 'April' }}</a>
                                <a class="dropdown-item"
                                    href="{{ url('att-list-monthly') }}/{{ session()->get('branch_id') }}/{{ session()->get('year') }}/{{ '05' }}">{{ 'May' }}</a>
                                <a class="dropdown-item"
                                    href="{{ url('att-list-monthly') }}/{{ session()->get('branch_id') }}/{{ session()->get('year') }}/{{ '06' }}">{{ 'June' }}</a>
                                <a class="dropdown-item"
                                    href="{{ url('att-list-monthly') }}/{{ session()->get('branch_id') }}/{{ session()->get('year') }}/{{ '07' }}">{{ 'July' }}</a>
                                <a class="dropdown-item"
                                    href="{{ url('att-list-monthly') }}/{{ session()->get('branch_id') }}/{{ session()->get('year') }}/{{ '08' }}">{{ 'August' }}</a>
                                <a class="dropdown-item"
                                    href="{{ url('att-list-monthly') }}/{{ session()->get('branch_id') }}/{{ session()->get('year') }}/{{ '09' }}">{{ 'September' }}</a>
                                <a class="dropdown-item"
                                    href="{{ url('att-list-monthly') }}/{{ session()->get('branch_id') }}/{{ session()->get('year') }}/{{ '10' }}">{{ 'October' }}</a>
                                <a class="dropdown-item"
                                    href="{{ url('att-list-monthly') }}/{{ session()->get('branch_id') }}/{{ session()->get('year') }}/{{ '11' }}">{{ 'November' }}</a>
                                <a class="dropdown-item"
                                    href="{{ url('att-list-monthly') }}/{{ session()->get('branch_id') }}/{{ session()->get('year') }}/{{ '12' }}">{{ 'December' }}</a>


                            </div>
                        </div>

                    </div>

                    <div class="col-md-9 col-lg-9 float-left">
                        @if (session()->get('branch_id'))
                            <div class="dropdown">

                                <a class="btn btn-outline-success btn-sm dropdown-toggle" href="#" role="button" id="shift"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Shift
                                </a>
                                @isset($shiftData)
                                    <a href="{{ url('generate-att-monthly-pdf') }}" role="button"
                                        class="btn btn-primary btn-sm mx-2">
                                        Download &nbsp;<i class="fas fa-file-download"></i>
                                    </a>
                                @endisset
                                <div class="dropdown-menu" aria-labelledby="shift">
                                    @foreach ($shift as $d)
                                        <a class="dropdown-item"
                                            href="{{ url('att-list-monthly') }}/{{ session()->get('branch_id') }}/{{ session()->get('year') }}/{{ session()->get('month') }}/{{ $d->id }}/{{ $d->type }}">{{ $d->shift_name }}</a>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            {{ 'Please select branch first !' }}
                        @endif

                    </div>

                </div>
            </div>
            <div class="col-lg-12 table_main">






                <div class="">
                    <h6 class=" py-2 ">Attendance list monthly @isset($shiftData)
                            - {{ $shiftData->shift_name }} - @if ($shiftData->type == 1)
                                {{ 'Day Shift' }}
                            @elseif($shiftData->type == 2)
                                {{ 'Night Shift' }}
                            @endif
                        @endisset
                    </h6>
                </div>

                <!-- table-responsive -->
                <table class="text-center" id="data">
                    <thead>
                        @isset($data)
                            <tr>
                                <th>S/N</th>
                                <th colspan="2">Employee</th>

                                @foreach ($dates as $date)
                                    <th>{{ $date }}</th>
                                @endforeach
                            </tr>
                        @endisset



                    </thead>
                    <tbody>

                        @isset($data)
                            @foreach ($data as $key => $item)
                                <tr class="data_tr">

                                    <td>{{ $sl++ }}</td>
                                    <td>{{ $item[0]['username'] }}</td>
                                    <td><img class="rounded-circle" alt="{{ $item[0]['username'] }}" height="40px"
                                            src="{{ asset('storage') }}/img/employee/{{ !empty($item[0]['employee_image']) ? $item[0]['employee_image'] : null }}">
                                    </td>

                                    @if (isset($item[0]['in_time']))
                                        @foreach ($item[0]['in_time'] as $in_data)
                                            @if ($in_data)
                                                @if ($in_data == 'H')
                                                    <td><span class="px-2 rounded bg-dark">H</span></td>
                                                @elseif ($in_data == 'LV')
                                                    <td><span class="px-2 rounded bg-info">LV</span></td>
                                                @else
                                                    @if (isset($shiftData->type) && $shiftData->type == 1)
                                                        @if (\Carbon\Carbon::parse($in_data)->format('H:i:s') < $shiftData->grace_time)
                                                            <td> <span class="bg-success px-2 rounded">P</span></td>
                                                        @elseif (\Carbon\Carbon::parse($in_data)->format('H:i:s') >= $shiftData->grace_time && \Carbon\Carbon::parse($in_data)->format('H:i:s') <= $shiftData->absent_time)
                                                            <td> <span class="px-2 rounded bg-warning">L</span></td>
                                                        @elseif (\Carbon\Carbon::parse($in_data)->format('H:i:s') >= $shiftData->absent_time)
                                                            <td><span class="px-2 rounded bg-danger">A</span></td>
                                                        @endif
                                                    @endif

                                                    @if (isset($shiftData->type) && $shiftData->type == 2)
                                                        @if (\Carbon\Carbon::parse($in_data)->format('H:i:s') < $shiftData->grace_time)
                                                            <td> <span class="bg-success px-2 rounded">P</span></td>
                                                        @elseif (\Carbon\Carbon::parse($in_data)->format('H:i:s') >= $shiftData->grace_time && \Carbon\Carbon::parse($in_data)->format('H:i:s') <= $shiftData->absent_time)
                                                            <td> <span class="px-2 rounded bg-warning">L</span></td>
                                                        @elseif (\Carbon\Carbon::parse($in_data)->format('H:i:s') >= $shiftData->absent_time)
                                                            <td><span class="px-2 rounded bg-danger">A</span></td>
                                                        @endif
                                                    @endif
                                                @endif
                                            @else
                                                <td><span class="px-2 rounded bg-danger">A</span></td>
                                            @endif
                                        @endforeach
                                    @else
                                        <td colspan="{{ $item[0]['last_day'] }}"><strong>Didn't punched this month
                                                !</strong>
                                        </td>
                                    @endif

                                </tr>
                            @endforeach
                        @endisset



                    </tbody>
                </table>


            </div>
            <div class="col-12">

            </div>


        </div>

        <!-- footer part -->
        @include('layouts.admin.partials.footer')
    </section>
@endsection

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

                                <div class="box_header m-0">
                                    <div class="col-md-4 float-left">

                                        <div class="dropdown float-left ">

                                            <a class="btn btn-outline-success btn-sm dropdown-toggle" href="#" role="button"
                                                id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                Branch
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                @foreach ($branch as $d)
                                                    <a class="dropdown-item"
                                                        href="{{ url('att-list') }}/{{ $d->id }}">{{ $d->branch_name }}</a>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="dropdown float-left ">
                                            <a class="btn btn-outline-success btn-sm dropdown-toggle" href="#" role="button"
                                                id="year" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                @if (session()->get('year'))
                                                    {{ session()->get('year') }}
                                                @else
                                                    {{ Carbon\Carbon::now()->year }}
                                                @endif
                                            </a>

                                            <div class="dropdown-menu" aria-labelledby="year">

                                                @foreach ($years as $year)
                                                    <a class="dropdown-item"
                                                        href="{{ url('att-list') }}/{{ session()->get('branch_id') }}/{{ $year->format('Y') }}">{{ $year->format('Y') }}</a>
                                                @endforeach

                                            </div>
                                        </div>

                                        <div class="dropdown float-left">
                                            <a class="btn btn-outline-success btn-sm dropdown-toggle" href="#" role="button"
                                                id="month" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                @if (session()->get('month'))
                                                    {{ Carbon\Carbon::parse('2022-' . session()->get('month') . '-05')->format('F') }}
                                                @else
                                                    {{ Carbon\Carbon::now()->format('F') }}
                                                @endif
                                            </a>

                                            <div class="dropdown-menu" aria-labelledby="month">

                                                <a class="dropdown-item"
                                                    href="{{ url('att-list') }}/{{ session()->get('branch_id') }}/{{ session()->get('year') }}/{{ '01' }}">{{ 'January' }}</a>
                                                <a class="dropdown-item"
                                                    href="{{ url('att-list') }}/{{ session()->get('branch_id') }}/{{ session()->get('year') }}/{{ '02' }}">{{ 'February' }}</a>
                                                <a class="dropdown-item"
                                                    href="{{ url('att-list') }}/{{ session()->get('branch_id') }}/{{ session()->get('year') }}/{{ '03' }}">{{ 'March' }}</a>
                                                <a class="dropdown-item"
                                                    href="{{ url('att-list') }}/{{ session()->get('branch_id') }}/{{ session()->get('year') }}/{{ '04' }}">{{ 'April' }}</a>
                                                <a class="dropdown-item"
                                                    href="{{ url('att-list') }}/{{ session()->get('branch_id') }}/{{ session()->get('year') }}/{{ '05' }}">{{ 'May' }}</a>
                                                <a class="dropdown-item"
                                                    href="{{ url('att-list') }}/{{ session()->get('branch_id') }}/{{ session()->get('year') }}/{{ '06' }}">{{ 'June' }}</a>
                                                <a class="dropdown-item"
                                                    href="{{ url('att-list') }}/{{ session()->get('branch_id') }}/{{ session()->get('year') }}/{{ '07' }}">{{ 'July' }}</a>
                                                <a class="dropdown-item"
                                                    href="{{ url('att-list') }}/{{ session()->get('branch_id') }}/{{ session()->get('year') }}/{{ '08' }}">{{ 'August' }}</a>
                                                <a class="dropdown-item"
                                                    href="{{ url('att-list') }}/{{ session()->get('branch_id') }}/{{ session()->get('year') }}/{{ '09' }}">{{ 'September' }}</a>
                                                <a class="dropdown-item"
                                                    href="{{ url('att-list') }}/{{ session()->get('branch_id') }}/{{ session()->get('year') }}/{{ '10' }}">{{ 'October' }}</a>
                                                <a class="dropdown-item"
                                                    href="{{ url('att-list') }}/{{ session()->get('branch_id') }}/{{ session()->get('year') }}/{{ '11' }}">{{ 'November' }}</a>
                                                <a class="dropdown-item"
                                                    href="{{ url('att-list') }}/{{ session()->get('branch_id') }}/{{ session()->get('year') }}/{{ '12' }}">{{ 'December' }}</a>


                                            </div>
                                        </div>

                                        <div class="dropdown float-left">
                                            <a class="btn btn-outline-success btn-sm dropdown-toggle" href="#" role="button"
                                                id="days" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                @if (session()->get('day'))
                                                    {{ session()->get('day') }}
                                                @else
                                                    {{ Carbon\Carbon::now()->day }}
                                                @endif


                                            </a>

                                            <div class="dropdown-menu customDays" aria-labelledby="days">

                                                @foreach ($days as $day)
                                                    <a class="dropdown-item"
                                                        href="{{ url('att-list') }}/{{ session()->get('branch_id') }}/{{ session()->get('year') }}/{{ session()->get('month') }}/{{ $day->format('d') }}">{{ $day->format('d') }}</a>
                                                @endforeach

                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-8 float-left">
                                        @if (session()->get('branch_id'))
                                            <div class="dropdown">

                                                <a class="btn btn-outline-success btn-sm dropdown-toggle" href="#"
                                                    role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    Select Shift
                                                </a>
                                                @isset($shiftData)
                                                    <a href="{{ url('generate-pdf') }}" role="button"
                                                        class="btn btn-primary btn-sm mx-1">
                                                        Download &nbsp;<i class="fas fa-file-download"></i>
                                                    </a>
                                                @endisset
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    @foreach ($shift as $d)
                                                        <a class="dropdown-item"
                                                            href="{{ url('att-list') }}/{{ session()->get('branch_id') }}/{{ session()->get('year') }}/{{ session()->get('month') }}/{{ session()->get('day') }}/{{ $d->id }}/{{ $d->type }}">{{ $d->shift_name }}</a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @else
                                            {{ 'Please select branch first !' }}
                                        @endif

                                    </div>

                                </div>



                                {{-- <div class="col-md-6">
                                        <div class="float-right">



                                            @isset($shiftData)
                                            <div class="btn bg-light text-dark mx-1 py-1">
                                                <strong>Emlployees</strong> &nbsp; <span
                                                    class="badge badge-info">{{ $totalEmployees }}</span>
                                            </div>
                                                <div class="btn bg-light text-dark mx-1 py-1">
                                                    <strong>Present</strong>&nbsp; <span
                                                        class="badge badge-success">{{ $totalEmployees - $absent }}</span>
                                                </div>
                                                <div class="btn bg-light text-dark mx-1 py-1">
                                                    <strong>Absent</strong> &nbsp;<span
                                                        class="badge badge-danger">{{ $absent }}</span>
                                                </div>
                                            @endisset

                                        </div>
                                    </div> --}}


                            </div>
                            <div class="white_card_body">
                                <div class="QA_section">
                                    <div class="white_box_tittle list_header">
                                        <h4 class="text-center">Attendance
                                            @isset($branchInfo)
                                                - {{ $branchInfo->branch_name }}
                                            @endisset

                                            @isset($shiftData)
                                                - {{ $shiftData->shift_name }} - @if ($shiftData->type == 1)
                                                    {{ 'Day Shift' }}
                                                @elseif($shiftData->type == 2)
                                                    {{ 'Night Shift' }}
                                                @endif
                                            @endisset
                                        </h4>
                                    </div>

                                    <div class="QA_table mb_30">
                                        <!-- table-responsive -->
                                        <table class="table lms_table_active table-striped">
                                            <thead>
                                                <tr>
                                                    <th scope="col">S/N</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Designation</th>
                                                    <th scope="col">Device User ID</th>
                                                    {{-- <th scope="col">Device</th>
                                                    <th scope="col">Device IP</th> --}}
                                                    <th scope="col">In Time</th>
                                                    <th scope="col">Out Time</th>
                                                    <th scope="col">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>


                                                @isset($data)
                                                    @if ($data == 'holiday')
                                                        <tr class="text-center">
                                                            <td colspan="9">
                                                                <h4>{{ 'Today is a holiday !' }}</h4>
                                                            </td>
                                                        </tr>
                                                    @else
                                                        @foreach ($data as $key => $item)
                                                            <tr>
                                                                <td>{{ $sl++ }}</td>
                                                                <td>{{ $item[0]['username'] }}</td>
                                                                <td>{{ $item[0]['designation'] }}</td>
                                                                <td>{{ $item[0]['user_id'] }}</td>
                                                                {{-- <td>{{ $item[0]['device_name'] }}</td>
                                                                <td>{{ $item[0]['dev_ipaddr'] }}</td> --}}
                                                                <td>
                                                                    @if ($item[0]['in_time'])
                                                                        {{ \Carbon\Carbon::parse($item[0]['in_time'])->format('d-m-y h:i:s a') }}
                                                                    @endif

                                                                </td>
                                                                <td>
                                                                    @if ($item[0]['in_time'])
                                                                        {{ \Carbon\Carbon::parse($item[0]['out_time'])->format('d-m-y h:i:s a') }}
                                                                    @endif

                                                                </td>
                                                                <td>
                                                                    @if ($item[0]['status'] == 'present')
                                                                        @if ($shiftData->type == 1)
                                                                            @if (isset($item[0]['in_time']))
                                                                                @if (\Carbon\Carbon::parse($item[0]['in_time'])->format('H:i:s') < $shiftData->grace_time)
                                                                                    <span
                                                                                        class="bg-success px-2 rounded">P</span>
                                                                                @elseif (\Carbon\Carbon::parse($item[0]['in_time'])->format('H:i:s') >= $shiftData->grace_time && \Carbon\Carbon::parse($item[0]['in_time'])->format('H:i:s') <= $shiftData->absent_time)
                                                                                    <span
                                                                                        class="px-2 rounded bg-warning">L</span>
                                                                                @elseif (\Carbon\Carbon::parse($item[0]['in_time'])->format('H:i:s') >= $shiftData->absent_time)
                                                                                    <span
                                                                                        class="px-2 rounded bg-danger">A</span>
                                                                                @endif
                                                                            @else
                                                                                <span class="px-2 rounded bg-danger">A</span>
                                                                            @endif
                                                                        @endif


                                                                        @if ($shiftData->type == 2)
                                                                            @if (isset($item[0]['in_time']))
                                                                                @if (\Carbon\Carbon::parse($item[0]['in_time'])->format('H:i:s') < $shiftData->grace_time)
                                                                                    <span
                                                                                        class="px-2 rounded bg-success">P</span>
                                                                                @elseif (\Carbon\Carbon::parse($item[0]['in_time'])->format('H:i:s') >= $shiftData->grace_time && \Carbon\Carbon::parse($item[0]['in_time'])->format('H:i:s') <= $shiftData->absent_time)
                                                                                    <span
                                                                                        class="px-2 rounded bg-warning">L</span>
                                                                                @elseif (\Carbon\Carbon::parse($item[0]['in_time'])->format('H:i:s') >= $shiftData->absent_time)
                                                                                    <span
                                                                                        class="px-2 rounded bg-danger">A</span>
                                                                                @endif
                                                                            @else
                                                                                <span class="px-2 rounded bg-danger">A</span>
                                                                            @endif
                                                                        @endif
                                                                    @elseif ($item[0]['status'] == 'absent')
                                                                        <span class="px-2 rounded bg-danger">A</span>
                                                                    @elseif ($item[0]['status'] == 'On Leave')
                                                                        <span class="px-2 rounded bg-secondary">On Leave</span>
                                                                    @endif
                                                                </td>

                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                @endisset

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

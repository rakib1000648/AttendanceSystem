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


        <div class="col-lg-12 table_main">


            <div class="col-md-12 float-left mb-2">

            <h4 class="">Monthly Attendance History</h4>

                <form action="{{url('monthly-attendance-history')}}" method="POST">
                @csrf
                    <div class="form-row align-items-center">
                        <div class="col-auto my-2">
                            <label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Preference</label>
                            <select class="custom-select-sm mr-sm-2 rounded" name="branch">
                                <option selected> Branch </option>
                                @foreach($branchs as $key => $branch)
                                <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-auto my-2">
                            <label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Preference</label>
                            <select class="custom-select-sm mr-sm-2 rounded" name="shift" >
                                <option selected> Shift </option>
                                @foreach($shifts as $key => $shift)
                                <option value="{{ $shift->id }}">{{ $shift->shift_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-auto my-2">
                            <label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Preference</label>
                            <select class="custom-select-sm mr-sm-2 rounded" name="year" >
                                <option selected> Year </option>
                                @foreach($years as $key => $year)
                                <option value="{{ $year->format('Y') }}">{{ $year->format('Y') }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-auto my-2">
                            <label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Preference</label>
                            <select class="custom-select-sm mr-sm-2 rounded" name="month" >
                                <option selected> Month </option>
                                @foreach($months as $key => $month)
                                <option value="{{ $month->format('m') }}">{{ $month->format('M') }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="col-auto my-2">
                            <button type="submit" class="btn btn-primary btn-sm">Generate</button>
                        </div>

                        <div class="col-auto my-1">
                            <label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Preference</label>
                            <a href="" class="btn btn-outline-info btn-sm"><i class="fas fa-file-pdf"></i> PDF</a>
                        </div>
                    </div>
                </form>
            </div>
                
            <!-- table-responsive -->
            <table class="text-center" id="data">
                <thead>

                    <tr>
                        <!-- <th>S/N</th> -->
                        {{-- <th colspan="1">Id</th> --}}
                        <th colspan="1">DevId</th>
                        <th colspan="1">Employee</th>


                        @foreach ($dates as $date)
                        <th>{{ $date }}</th>
                        @endforeach
                    </tr>


                </thead>
                <tbody>
                    @foreach($users as $user)
                    
                    <tr class="data_tr">

                        {{-- <td>{{$user->user_id}}</td> --}}
                        <td>{{$user->dev_emp_id}}</td>
                        <td>{{$user->name}}</td>

                        @foreach ($dates as $date)
                        
                        

                        @foreach($data as $att)
                        @if($user->dev_emp_id==$att->DevUserId)

                            @if ($date == \Carbon\Carbon::parse($att->Dates)->format('d'))
                            <td>
                                {{ \Carbon\Carbon::parse($att->Dates)->format('d') }}
                                {{-- @if($att->AttendanceStatus == 'P')
                                <span class="bg-success px-2 rounded">P</span>
                                @elseif($att->AttendanceStatus == 'L')
                                <span class="bg-warning px-2 rounded">L</span>
                                @elseif($att->AttendanceStatus == 'A')
                                <span class="bg-danger px-2 rounded">A</span>
                                @elseif($att->AttendanceStatus == 'E')
                                <span class="bg-dark px-2 rounded">E</span>
                                @elseif($att->AttendanceStatus == 'Lv')
                                <span class="bg-dark px-2 rounded">Lv</span>
                                @elseif($att->AttendanceStatus == 'W')
                                <span class="bg-info px-2 rounded">W</span>
                                @endif                        --}}
                            </td>

                            @endif

                        @endif
                        @endforeach

                        @endforeach
                        



                    </tr>
                   
                    @endforeach



                </tbody>
            </table>


        </div>
        <br>
        <div class="col-12">

        </div>

    </div>

    <!-- footer part -->
    @include('layouts.admin.partials.footer')
</section>
@endsection
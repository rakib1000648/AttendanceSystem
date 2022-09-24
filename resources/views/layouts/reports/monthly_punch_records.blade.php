@extends('layouts.master_admin')

@section('content')
<section class="main_content dashboard_part large_header_bg">
    <!-- menu  -->
    @include('layouts.admin.partials.header')
    <!--/ menu  -->
    <style>
        #info {
          font-family: arial, sans-serif;
          border-collapse: collapse;
          width: 100%;
        }
        
        #info, .info-tr, .info-td{
        border:1px solid rgb(161, 158, 158);
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
                                    <h4 class="text-center">Monthly Punch Records</h4>
                                </div>

                                <div class="col-md-8 float-left">

                                    <form action="{{ url('monthly-punch-records') }}" method="POST">
                                        @csrf
                                        <div class="form-row align-items-center">
                                            <input type="text" name="user_id" value="{{ $user_id }}" hidden>
                                            <div class="col-auto my-1">
                                                <label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Preference</label>
                                                <select class="custom-select-sm mr-sm-2 rounded" name="year" id="inlineFormCustomSelect">
                                                  <option selected> Year </option>
                                                  @foreach($years as $key => $year)
                                                  <option value="{{ $year->format('Y') }}" @if ($year->format('Y')==$seletedYear)
                                                      {{ 'Selected' }}
                                                  @endif>{{ $year->format('Y') }}</option>
                                                  @endforeach
                                                </select>
                                              </div>

                                              <div class="col-auto my-1">
                                                <label class="mr-sm-2 sr-only" for="inlineFormCustomSelect2">Preference</label>
                                                <select class="custom-select-sm mr-sm-2 rounded" name="month" id="inlineFormCustomSelect2">
                                                  <option selected> Month </option>
                                                  @foreach($months as $key => $month)
                                                  <option value="{{ $month->format('m') }}" @if ($month->format('m')==$seletedMonth)
                                                    {{ 'Selected' }}
                                                @endif >{{ $month->format('M') }}</option>
                                                  @endforeach
                                                </select>
                                              </div>


                                            <div class="col-auto my-1">
                                                <button type="submit" class="btn btn-primary btn-sm">Generate</button>
                                            </div>

                                            <div class="col-auto my-1">
                                                <label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Preference</label>
                                                <a href="{{ url('monthly-punch-records-pdf') }}" class="btn btn-outline-info btn-sm"><i class="fas fa-file-pdf"></i> PDF</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                @isset($data_common)
                                <div class="col-md-4 float-left">
                                    <table id="info" style="width:100%">
                                        <tr class="info-tr">
                                          <td class="info-td"><b>Employee Name</b></td>
                                          <td class="info-td">{{ $data_common->UserName }}</td>
                                        </tr>
                                        <tr class="info-tr">
                                          <td class="info-td"><b>Device User Id</b></td>
                                          <td class="info-td">{{ $data_common->DevUserId }}</td>
                                        </tr>
                                        <tr class="info-tr">
                                          <td class="info-td"><b>Designation</b></td>
                                          <td class="info-td">{{ $data_common->designation }}</td>
                                        </tr>
                                        <tr class="info-tr">
                                          <td class="info-td"><b>Department</b></td>
                                          <td class="info-td">{{ $data_common->department_name }}</td>
                                        </tr>
                                        <tr class="info-tr">
                                          <td class="info-td"><b>Branch</b></td>
                                          <td class="info-td">{{ $data_common->branch_name }}</td>
                                        </tr>
                                        <tr class="info-tr">
                                          <td class="info-td"><b>Shift</b></td>
                                          <td class="info-td">{{ $data_common->shift_name }}</td>
                                        </tr>
                                      </table>
                                </div>
                                @endisset


                                <div class="QA_table mb_30">
                                    <!-- table-responsive -->
                                    <div class="QA_table mb_30">
                                        <!-- table-responsive -->
                                        <table class="table lms_table_active table-striped">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Sl</th>
                                                    <th scope="col">Punched Date</th>
                                                    <th scope="col">Check In</th>
                                                    <th scope="col">Check Out</th>
                                                    <th scope="col">Working Duration</th>
                                                    <th scope="col">Marking</th>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $key => $d)
                                                <tr>
                                                    <td>{{ $key+1 }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($d->LoginDate)->format('d-m-Y') }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($d->LoginTime)->format('h:i:s a') }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($d->LogoutTime)->format('h:i:s a') }}</td>
                                                    <td>
                                                        @if ($d->LoginTime==$d->LogoutTime)
                                                            {{ '00:00:00' }}
                                                        @else
                                                        {{ date('h:i:s', strtotime($d->LogoutTime)-(strtotime($d->LoginTime))) }}
                                                        @endif
                                                    </td>
                                                    <td>{{ $d->AttendanceStatus }}</td>
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
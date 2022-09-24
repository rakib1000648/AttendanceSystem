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
                                    <h4 class="text-center">Monthly Punch Records</h4>
                                </div>
{{-- 
                                <div class="col-md-12 float-left">

                                    <form>
                                        <div class="form-row align-items-center">
                                            <div class="col-auto my-1">
                                                <label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Preference</label>
                                                <select class="custom-select-sm mr-sm-2 rounded" id="inlineFormCustomSelect">
                                                  <option selected> Year </option>
                                                  @foreach($years as $key => $year)
                                                  <option value="{{ $year->format('Y') }}">{{ $year->format('Y') }}</option>
                                                  @endforeach
                                                </select>
                                              </div>

                                              <div class="col-auto my-1">
                                                <label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Preference</label>
                                                <select class="custom-select-sm mr-sm-2 rounded" id="inlineFormCustomSelect">
                                                  <option selected> Month </option>
                                                  @foreach($months as $key => $month)
                                                  <option value="{{ $month->format('m') }}">{{ $month->format('M') }}</option>
                                                  @endforeach
                                                </select>
                                              </div>


                                            <div class="col-auto my-1">
                                                <button type="submit" class="btn btn-primary btn-sm">Generate</button>
                                            </div>

                                            <div class="col-auto my-1">
                                                <label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Preference</label>
                                                <a href="" class="btn btn-outline-info btn-sm"><i class="fas fa-file-pdf"></i> PDF</a>
                                            </div>
                                        </div>
                                    </form>
                                </div> --}}

                                <div class="QA_table mb_30">
                                    <!-- table-responsive -->
                                    <div class="QA_table mb_30">
                                        <!-- table-responsive -->
                                        <table class="table lms_table_active ">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Sl</th>
                                                    <th scope="col">Employee</th>
                                                    <th scope="col">Designation</th>
                                                    <th scope="col">Department</th>
                                                    <th scope="col">Shift</th>
                                                    <th scope="col">Branch</th>
                                                    <th scope="col">Record</th>
                                            </thead>
                                            <tbody>
                                                @foreach ($users as $key => $u)
                                                <tr>
                                                    <td>{{ $key+1 }}</td>
                                                    <td>{{ $u->name }}</td>
                                                    <td>{{ $u->designation }}</td>
                                                    <td>{{ $u->department_name }}</td>
                                                    <td>{{ $u->shift_name }}</td>
                                                    <td>{{ $u->branch_name }}</td>
                                                    <td>
                                                        <a href="{{ url('monthly-punch-records') }}/{{ $u->dev_emp_id }}" class="btn btn-light btn-sm"><i class="fas fa-search-plus"></i></a>
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
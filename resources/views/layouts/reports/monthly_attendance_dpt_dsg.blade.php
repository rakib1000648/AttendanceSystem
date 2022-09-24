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
                                    <h4 class="text-center">Monthly Attendance Department/Designation</h4>
                                </div>

                                <div class="col-md-12 float-left">

                                    <form>
                                        <div class="form-row align-items-center">
                                            <div class="col-auto my-1">
                                                <label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Preference</label>
                                                <select class="custom-select-sm mr-sm-2 rounded" id="inlineFormCustomSelect">
                                                  <option selected> Department </option>
                                                  @foreach($Department as $key => $department)
                                                  <option value="{{ $department->id }}">{{ $department->department_name }}</option>
                                                  @endforeach
                                                </select>
                                            </div>
                                            <div class="col-auto my-1">
                                                <label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Preference</label>
                                                <select class="custom-select-sm mr-sm-2 rounded" id="inlineFormCustomSelect">
                                                  <option selected> Designation </option>
                                                  @foreach($Designation as $key => $designation)
                                                  <option value="{{ $designation->id }}">{{ $designation->designation }}</option>
                                                  @endforeach
                                                </select>
                                            </div>
                                            <div class="col-auto my-1">
                                                <label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Preference</label>
                                                <select class="custom-select-sm mr-sm-2 rounded" id="inlineFormCustomSelect">
                                                  <option selected> Year </option>
                                                  @foreach($year as $key => $year)
                                                  <option value="{{ $year->format('Y') }}">{{ $year->format('Y') }}</option>
                                                  @endforeach
                                                </select>
                                            </div>

                                            <div class="col-auto my-1">
                                                <label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Preference</label>
                                                <select class="custom-select-sm mr-sm-2 rounded" id="inlineFormCustomSelect">
                                                  <option selected> Month </option>
                                                  @foreach($month as $key => $month)
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
                                                    <th scope="col">Designation</th>
                                                    <th scope="col">Department</th>
                                                    <th scope="col">Office Start</th>
                                                    <th scope="col">Grace</th>
                                                    <th scope="col">Present</th>
                                                    <th scope="col">Marking</th>
                                                    <th scope="col">Actions</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1-1-2021</td>
                                                    <td>Sazzad Kobir</td>
                                                    <td>GM</td>
                                                    <td>Inventory</td>
                                                    <td>06:30</td>
                                                    <td>09:30</td>
                                                    <td>10:30</td>
                                                    <td>Absent</td>
                                                    <td>
                                                        <a href="#" class="btn btn-light btn-sm"><i class="fas fa-edit"></i></a>
                                                        <a href="#" class="btn btn-light btn-sm"><i class="fas fa-search-plus"></i></a>
                                                        <a href="#" class="btn btn-light btn-sm"><i class="fas fa-times" style="color: red"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>1-1-2021</td>
                                                    <td>Sazzad Kobir</td>
                                                    <td>GM</td>
                                                    <td>Inventory</td>
                                                    <td>06:30</td>
                                                    <td>09:30</td>
                                                    <td>10:30</td>
                                                    <td>Absent</td>
                                                    <td>
                                                        <a href="#" class="btn btn-light btn-sm"><i class="fas fa-edit"></i></a>
                                                        <a href="#" class="btn btn-light btn-sm"><i class="fas fa-search-plus"></i></a>
                                                        <a href="#" class="btn btn-light btn-sm"><i class="fas fa-times" style="color: red"></i></a>
                                                    </td>
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
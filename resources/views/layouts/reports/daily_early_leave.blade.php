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
                                    <h4 class="text-center">Daily Early Leave</h4>
                                </div>

                                <div class="col-md-12 float-left">

                                    <form>
                                        <div class="form-row align-items-center">
                                            <div class="col-auto my-1">
                                                <input type="date" class="form-control-sm" name="">
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
                                                    <th scope="col">Leave</th>
                                                    <th scope="col">Office End</th>
                                                    <th scope="col">Reason</th>
                                                    <th scope="col">Approaved By</th>
                                                    <th scope="col">Actions</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>18-1-2020</td>
                                                    <td>Sazzad Kobir</td>
                                                    <td>3:45PM</td>
                                                    <td>8:30</td>
                                                    <td>Urgent Meeting</td>
                                                    <td>Mahbubul</td>
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
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
                                    <div class="main-title">
                                    </div>
                                </div>
                            </div>
                            <div class="white_card_body">
                                <div class="QA_section">
                                    <div class="white_box_tittle list_header">
                                        <h4>Holiday</h4>
                                        <div class="box_right d-flex lms_block">
                                            <div class="serach_field_2">

                                            </div>
                                            <div class="add_button ml-10">
                                                <a href="{{ url('create-holiday') }}" class="btn_1">Add
                                                    New</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="QA_table mb_30">
                                        <!-- table-responsive -->
                                        <table class="table lms_table_active">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Branch</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Total Days</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $d)
                                                    <tr>
                                                        <td>{{ $no++ }}</td>
                                                        <td>{{ $d->holiday_name }}</td>
                                                        <td>{{ $d->branch_name }}, {{ $d->branch_location }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($d->start_date)->format('d/m/y') }} - {{ \Carbon\Carbon::parse($d->end_date)->format('d/m/y') }}</td>
                                                        <td>
                                                            @if ($d->start_date == $d->end_date)
                                                                <b><span class="text-danger">{{ '1' }}</span></b>
                                                            @else
                                                                <b><span class="text-danger">{{ \Carbon\Carbon::parse($d->start_date)->diffInDays(\Carbon\Carbon::parse($d->end_date)) + 1 }}</span></b>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{ url('edit-holiday/'.$d->id) }}"
                                                                class="btn btn-outline-info btn-sm rounded-pill px-2"><i
                                                                    class="fas fa-edit f_s_14 mr-2"></i>EDIT</a>

                                                            <a href="{{ url('delete-holiday/'.$d->id) }}"
                                                                class="btn btn-outline-danger btn-sm rounded-pill px-2"><i
                                                                    class="fas fa-trash f_s_14 mr-2"></i>DELETE</a>
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
                    <div class="col-12">

                    </div>
                </div>
            </div>
        </div>

        <!-- footer part -->
        @include('layouts.admin.partials.footer')
    </section>
@endsection

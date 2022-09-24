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
                                        <h4>Employee Leaves</h4>
                                        <div class="box_right d-flex lms_block">
                                            <div class="serach_field_2">

                                            </div>
                                            <div class="add_button ml-10">
                                                <a href="{{ url('create-leave') }}" class="btn_1">Add
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
                                                    <th scope="col">Type</th>
                                                    <th scope="col">Reason</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Total Days</th>
                                                    <th scope="col">Approver/Rejector</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $d)
                                                    <tr>
                                                        <td><b>{{ $no++ }}</b></td>
                                                        <td>{{ $d->name }}</td>
                                                        <td>{{ $d->type }}</td>
                                                        <td>{{ $d->leave_cause }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($d->leave_start_date)->format('d/m/y') }} - {{ \Carbon\Carbon::parse($d->leave_end_date)->format('d/m/y') }}</td>
                                                        <td>
                                                            @if ($d->leave_start_date == $d->leave_end_date)
                                                            <b><span class="text-danger">{{ '1' }}</span></b>
                                                            @else
                                                            <b><span class="text-danger">{{ \Carbon\Carbon::parse($d->leave_start_date)->diffInDays(\Carbon\Carbon::parse($d->leave_end_date)) + 1 }}</span></b>
                                                            @endif
                                                        </td>
                                                        <td>{{ $d->appr_name }}</td>
                                                        <td>@if ($d->approval_status == 1)
                                                            <span class="text-primary alert-primary px-2 py-1 rounded">{{ 'Pending' }}</span>
                                                        @elseif($d->approval_status == 2)
                                                            <span class="text-success alert-success px-2 py-1 rounded">{{ 'Approved' }}</span>
                                                        @elseif($d->approval_status == 3)
                                                            <span class="text-danger alert-danger px-2 py-1 rounded">{{ 'Rejected' }}</span>
                                                        @endif</td>

                                                        <td>
                                                            @if ($d->approval_status == 1)
                                                            <a href="{{ url('approve-leave/'.$d->id) }}"
                                                                class="btn alert-success btn-sm rounded"><i
                                                                    class="fas fa-check"></i></a>

                                                            <a href="{{ url('reject-leave/'.$d->id) }}"
                                                                class="btn alert-danger btn-sm rounded"><i
                                                                    class="fas fa-ban"></i></a>
                                                            <a href="{{ url('edit-leave/'.$d->id) }}"
                                                                class="btn alert-info btn-sm rounded"><i
                                                                    class="fas fa-edit"></i></a>
                                                            @endif

                                                            <a href="{{ url('delete-leave/'.$d->id) }}"
                                                                class="btn btn-danger btn-sm rounded "><i
                                                                    class="fas fa-trash-alt"></i></a>
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

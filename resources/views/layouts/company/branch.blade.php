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
                                        {{-- <h3 class="m-0">Branches</h3> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="white_card_body">
                                <div class="QA_section">
                                    <div class="white_box_tittle list_header">
                                        <h4>Branches</h4>
                                        <div class="box_right d-flex lms_block">
                                            <div class="serach_field_2">

                                            </div>
                                            <div class="add_button ml-10">
                                                <a href="{{ url('create-branch') }}" class="btn_1">Add
                                                    New</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="QA_table mb_30">
                                        <!-- table-responsive -->
                                        <table class="table lms_table_active ">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Branch</th>
                                                    <th scope="col">Location</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $d)
                                                    <tr>
                                                        <td>{{ $no++ }}</td>
                                                        <td>{{ $d->branch_name }}</td>
                                                        <td>{{ $d->branch_location }}</td>

                                                        <td>
                                                            <a href="{{ url('edit-branch/'. $d->id) }}"
                                                                class="btn btn-outline-primary btn-sm rounded-pill px-3"><i
                                                                    class="fas fa-edit f_s_14 mr-2"></i>EDIT</a>
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

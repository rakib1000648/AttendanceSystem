@extends('layouts.master_admin')

@section('content')
<section class="main_content dashboard_part large_header_bg">
    <!-- menu  -->
@include('layouts.admin.partials.header')
<!--/ menu  -->
<div class="main_content_iner overly_inner ">
    <div class="container-fluid p-0 ">
        <!-- page title  -->
        <div class="row">
            <div class="col-12">
                <div class="page_title_box d-flex align-items-center justify-content-between">
                    <div class="page_title_left">
                        <h3 class="f_s_30 f_w_700 text_white" >Dashboard</h3>

                    </div>
                    {{-- <a href="#" class="white_btn3">Create Report</a> --}}
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="col-lg-12 card_height_100">

                {{-- <div class="white_card mb_20 py-4"> --}}
                  @if (auth()->user()->can('dashboard'))
                  <a href="{{ url('employees') }}">
                    <div class="col-xl-3 col-sm-4 col-md-12 float-left mb-3">
                        <div class="card">
                          <div class="card-content">
                            <div class="card-body">
                              <div class="media d-flex">
                                <div class="align-self-center">
                                    <i class="fas fa-users fa-3x" style="color: #64C5B1;"></i>
                                </div>
                                <div class="media-body text-right mt-2">
                                  <h6>Employees</h6>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </a>

                <a href="{{ url('att-list') }}">
                    <div class="col-xl-3 col-sm-4 col-md-12 float-left mb-3">
                        <div class="card">
                          <div class="card-content">
                            <div class="card-body">
                              <div class="media d-flex">
                                <div class="align-self-center">
                                    <i class="fas fa-clipboard-list fa-3x" style="color: #64C5B1;"></i>
                                </div>
                                <div class="media-body text-right mt-2">
                                  <h6>D-Attendance</h6>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </a>

                <a href="{{ url('att-list-monthly') }}">
                    <div class="col-xl-3 col-sm-4 col-md-12 float-left mb-3">
                        <div class="card">
                          <div class="card-content">
                            <div class="card-body">
                              <div class="media d-flex">
                                <div class="align-self-center">
                                    <i class="fas fa-clipboard-list fa-3x" style="color: #64C5B1;"></i>
                                </div>
                                <div class="media-body text-right mt-2">
                                  <h6>M-Attendance</h6>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </a>

                <a href="{{ url('leaves-yearly') }}">
                    <div class="col-xl-3 col-sm-4 col-md-12 float-left mb-3">
                        <div class="card">
                          <div class="card-content">
                            <div class="card-body">
                              <div class="media d-flex">
                                <div class="align-self-center">
                                    <i class="fas fa-table fa-3x" style="color: #64C5B1;"></i>
                                </div>
                                <div class="media-body text-right mt-2">
                                  <h6>Leave Report</h6>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </a>
                  @else
                  <div class="white_card mb_20">
                    <div class="white_card_body renew_report_card d-flex align-items-center justify-content-between flex-wrap">
                        <div class="renew_report_left">
                            <h4 class="f_s_19 f_w_600 color_theme2 mb-0" >Welcome to Master Fishing</h4>
                            <p class="color_gray2 f_s_12 f_w_600" >Thank You.</p>
                        </div>

                    </div>
                </div>
                  @endif
                   


                {{-- </div> --}}


            </div>



        </div>
    </div>
</div>

<!-- footer part -->
@include('layouts.admin.partials.footer')
</section>

@endsection


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
                        <h4 class="f_s_30 f_w_700 text_white" >{{ $role->name }} - Permissions</h4>

                    </div>
                    {{-- <a href="#" class="white_btn3">Create Report</a> --}}
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="col-lg-12 card_height_100">

                <div class="white_card mb_20">
                    <div class="white_card_body renew_report_card d-flex  justify-content-start flex-wrap">
                        @if(!empty($rolePermissions))
                        @foreach($rolePermissions as $v)
                            <div class="shadow p-3 mb-5 bg-white rounded mx-2"><strong>{{ $v->name }}</strong></div>
                        @endforeach
                    @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- footer part -->
@include('layouts.admin.partials.footer')
</section>

@endsection

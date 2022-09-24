@extends('layouts.master_admin')

@section('content')
<section class="main_content dashboard_part large_header_bg">
    <!-- menu  -->
@include('layouts.admin.partials.header')
<!--/ menu  -->

<div class="main_content_iner ">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">

            <div class="col-lg-8 mt-5">
                <div class="white_card card_height_100 mb_30">
                    <div class="white_card_header">
                        <div class="box_header m-0">
                            <div class="main-title">
                                <h3 class="m-0">Edit Employee position</h3>
                            </div>
                        </div>
                    </div>
                    <div class="white_card_body">

                        <form action="{{ url('edit-employee-position') }}" method="POST">
                            @method('PUT')
                            @csrf
                            <input type="text" name="id" value="{{ $data->id }}" hidden>
                            <div class="form-group">
                                <label for="employee-position">Type</label>
                                <input type="text" name="position_name" value="{{ $data->position_name }}" class="form-control" id="employee-position" placeholder="Enter position name">
                                @if ($errors->has('position_name'))
                                    <span class="text-danger">{{ $errors->first('position_name') }}</span>
                                @endif
                            </div>

                            <div class="form-group mt-3 mb-0">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>

                        </form>


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


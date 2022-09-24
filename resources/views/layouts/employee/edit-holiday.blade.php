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
                                <h3 class="m-0">Set Holiday</h3>
                            </div>
                        </div>
                    </div>
                    <div class="white_card_body">

                        <form action="{{ url('edit-holiday') }}" method="POST">
                            @method('PUT')
                            @csrf

                            <input type="text" value="{{ $data->id }}" name="id" hidden>
                            <div class="form-group">
                                <label for="holiday_name">Holiday Name:</label>
                                <input type="text" class="form-control" value="{{ $data->holiday_name }}" name="holiday_name" id="holiday_name" placeholder="Enter holiday name...">
                                @if ($errors->has('holiday_name'))
                                <span class="text-danger">{{ $errors->first('holiday_name') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="branch_id">Select Branch:</label>
                                <select name="branch_id" class="form-control" id="branch_id">
                                    <option value="">Choose...</option>
                                    @foreach ($branch as $item)
                                        <option value="{{ $item->id }}" @if ($item->id == $data->branch_id)
                                            Selected
                                        @endif>{{ $item->branch_name }} - {{ $item->branch_location }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('branch_id'))
                                <span class="text-danger">{{ $errors->first('branch_id') }}</span>
                                @endif
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="sdate">Start Date:</label>
                                    <div class="form-group mb-0">
                                        <input type="date" class="form-control" value="{{ $data->start_date }}" name="start_date" id="sdate">
                                    </div>
                                    @if ($errors->has('start_date'))
                                        <span class="text-danger">{{ $errors->first('start_date') }}</span>
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="edate">End Date:</label>
                                    <div class="form-group mb-0">
                                        <input type="date" class="form-control" value="{{ $data->end_date }}" name="end_date" id="edate">
                                    </div>
                                    @if ($errors->has('end_date'))
                                        <span class="text-danger">{{ $errors->first('end_date') }}</span>
                                    @endif
                                </div>
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


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
                                <h3 class="m-0">Edit Shift</h3>
                            </div>
                        </div>
                    </div>
                    <div class="white_card_body">

                        <form action="{{ url('edit-shift') }}" method="POST">
                            @method('PUT')
                            @csrf
                            <input type="text" name="id" value="{{ $data->id }}" hidden>
                            <div class="form-group">
                                <label for="shift_name">Shift Name:</label>
                                <input type="text" class="form-control" name="shift_name" value="{{ $data->shift_name }}" id="shift_name" placeholder="Enter shift name...">
                                @if ($errors->has('shift_name'))
                                <span class="text-danger">{{ $errors->first('shift_name') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="Type">Shift Type:</label>
                                <select id="Type" class="form-control" name="type">
                                    <option value="1" @if ($data->type == 1) Selected @endif>Day Shift</option>
                                    <option value="2" @if ($data->type == 2) Selected @endif>Night Shift</option>
                                </select>
                                @if ($errors->has('type'))
                                <span class="text-danger">{{ $errors->first('type') }}</span>
                                @endif
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="stime">Working Start Time:</label>
                                    <div class="form-group mb-0">
                                        <input type="time" value="{{date('H:i', strtotime($data->start_time)) }}" class="form-control" name="start_time" id="stime">
                                    </div>
                                    @if ($errors->has('start_time'))
                                        <span class="text-danger">{{ $errors->first('start_time') }}</span>
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="etime">Working End Time:</label>
                                    <div class="form-group mb-0">
                                        <input type="time" value="{{date('H:i', strtotime($data->end_time)) }}" class="form-control" name="end_time" id="etime">
                                    </div>
                                    @if ($errors->has('end_time'))
                                        <span class="text-danger">{{ $errors->first('end_time') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="Gracetime">Grace Time <span>(Optional):</span></label>
                                <div class="form-group mb-0">
                                    <input type="time"                                         @if (!is_Null($data->grace_time))
                                    value="{{date('H:i', strtotime($data->grace_time)) }}"
                                    @else
                                    value = ""
                                    @endif
                                    class="form-control" name="grace_time" id="Gracetime">
                                </div>
                                @if ($errors->has('grace_time'))
                                    <span class="text-danger">{{ $errors->first('grace_time') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="absent_time">Absent Time <span>(Optional):</span></label>
                                <div class="form-group mb-0">
                                    <input type="time"
                                        @if (!is_Null($data->absent_time))
                                        value="{{date('H:i', strtotime($data->absent_time)) }}"
                                        @else
                                        value = ""
                                        @endif
                                    class="form-control" name="absent_time" id="absent_time">
                                </div>
                                @if ($errors->has('absent_time'))
                                    <span class="text-danger">{{ $errors->first('absent_time') }}</span>
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


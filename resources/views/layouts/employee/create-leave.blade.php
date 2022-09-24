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
                                <h3 class="m-0">Add Employee leave</h3>
                            </div>
                        </div>
                    </div>
                    <div class="white_card_body">

                        <form action="{{ url('create-leave') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="user_id">Select Employee:</label>
                                <select id="user_id" class="form-control" name="user_id">
                                    <option value="">Choose...</option>
                                    @foreach ($employee as $d)
                                    <option value="{{ $d->dev_emp_id }}">{{ $d->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('user_id'))
                                <span class="text-danger">{{ $errors->first('user_id') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="leave_type_id">Select Type:</label>
                                <select id="leave_type_id" class="form-control" name="leave_type_id">
                                    <option value="">Choose...</option>
                                    @foreach ($leave_type as $d)
                                    <option value="{{ $d->id }}">{{ $d->type }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('leave_type_id'))
                                <span class="text-danger">{{ $errors->first('leave_type_id') }}</span>
                                @endif
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="sdate">Start Date:</label>
                                    <div class="form-group mb-0">
                                        <input type="date" class="form-control" name="leave_start_date" id="sdate">
                                    </div>
                                    @if ($errors->has('leave_start_date'))
                                        <span class="text-danger">{{ $errors->first('leave_start_date') }}</span>
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="edate">End Date:</label>
                                    <div class="form-group mb-0">
                                        <input type="date" class="form-control" name="leave_end_date" id="edate">
                                    </div>
                                    @if ($errors->has('leave_end_date'))
                                        <span class="text-danger">{{ $errors->first('leave_end_date') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">Cause of leave:</label>
                                <textarea name="leave_cause" class="form-control" cols="30" rows="2" placeholder="Write here..."></textarea>
                                @if ($errors->has('leave_cause'))
                                    <span class="text-danger">{{ $errors->first('leave_cause') }}</span>
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


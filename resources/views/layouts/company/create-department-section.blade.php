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
                                <h3 class="m-0">Create Department Section</h3>
                            </div>
                        </div>
                    </div>
                    <div class="white_card_body">

                        <form action="{{ url('create-department-section') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="inputStatus">Select Department</label>
                                <select id="inputStatus" class="form-control" name="dept_id">
                                    <option value="">Choose...</option>
                                    @foreach ($data as $d)
                                    <option value="{{ $d->id }}">{{ $d->department_name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('dept_id'))
                                <span class="text-danger">{{ $errors->first('dept_id') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="section_name">Section name</label>
                                <input type="text" name="section_name" class="form-control" id="section_name" placeholder="Enter section name">
                                @if ($errors->has('section_name'))
                                    <span class="text-danger">{{ $errors->first('section_name') }}</span>
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


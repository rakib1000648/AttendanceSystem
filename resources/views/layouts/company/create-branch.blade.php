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
                                <h3 class="m-0">Create Branch</h3>
                            </div>
                        </div>
                    </div>
                    <div class="white_card_body">

                        <form action="{{ url('create-branch') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="Branch">Branch Name</label>
                                <input type="text" name="branch_name" class="form-control" id="Branch" placeholder="Enter branch name">
                                @if ($errors->has('branch_name'))
                                    <span class="text-danger">{{ $errors->first('branch_name') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="Location">Branch Location</label>
                                <textarea name="branch_location" id="Location" class="form-control" cols="30" rows="2" placeholder="Write here...."></textarea>
                                @if ($errors->has('branch_location'))
                                <span class="text-danger">{{ $errors->first('branch_location') }}</span>
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


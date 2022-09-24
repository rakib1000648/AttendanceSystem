@extends('layouts.master_admin')

@section('content')
<section class="main_content dashboard_part large_header_bg">
    <!-- menu  -->
@include('layouts.admin.partials.header')
<!--/ menu  -->
<style>
    label {
     border:1px solid rgb(255, 255, 255);
     padding:10px;
     border-radius: 3px 3px 3px 3px;
    -webkit-border-radius: 3px 3px 3px 3px;
    -moz-border-radius: 3px 3px 3px 3px;

    box-shadow: 0px 15px 36px -14px rgba(153,152,152,0.54);
    -webkit-box-shadow: 0px 15px 36px -14px rgba(153,152,152,0.54);
    -moz-box-shadow: 0px 15px 36px -14px rgba(153,152,152,0.54);

     display:block;
    }

    label:hover {
     background:rgb(110, 71, 105);
     color: #ccc;
     cursor:pointer;
    }
</style>

<div class="main_content_iner ">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">

            <div class="col-lg-10">
                <div class="white_card card_height_100 mb_30">
                    <div class="white_card_header">
                        <div class="box_header m-0">
                            <div class="main-title">
                                <h3 class="m-0">Create Role</h3>
                            </div>
                        </div>
                    </div>
                    <div class="white_card_body">

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                </ul>
                            </div>
                        @endif

                        {!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
                            <div class="form-group">

                                {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}

                            </div>

                            <div class="accordion accordion_custom mb_50" id="accordion_ex">
                                <div class="card">
                                    <div class="card-header" id="headingThree">
                                        <h2 class="mb-0">
                                            <a href="#" class="btn collapsed" type="button"
                                                data-toggle="collapse" data-target="#collapseThree"
                                                aria-expanded="false" aria-controls="collapseThree">
                                                Permissions
                                            </a>
                                        </h2>
                                    </div>
                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                        data-parent="#accordion_ex">
                                        <div class="card-body">
                                            @foreach($permission as $value)
                                                <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                                                {{ $value->name }}</label>
                                            <br/>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group form-check">

                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        {!! Form::close() !!}


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


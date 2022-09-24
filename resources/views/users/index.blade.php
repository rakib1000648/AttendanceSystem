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
                                <h3 class="m-0">Users Management</h3>
                            </div>
                        </div>
                    </div>
                    <div class="white_card_body">
                        <div class="QA_section">
                            <div class="white_box_tittle list_header">
                                <h4>Table</h4>
                                <div class="box_right d-flex lms_block">
                                    <div class="serach_field_2">
                                        <div class="search_inner">

                                        </div>
                                    </div>
                                    <div class="add_button ml-10">
                                        <a href="{{ route('users.create') }}" class="btn_1">Add New</a>
                                    </div>
                                </div>
                            </div>

                            <div class="QA_table mb_30">
                                <!-- table-responsive -->
                                <table class="table lms_table_active ">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Roles</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $user)
                                        <tr>

                                            <td>{{ ++$i }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                            @if(!empty($user->getRoleNames()))
                                                @foreach($user->getRoleNames() as $v)
                                                <span class="bg-succcess">{{ $v }}</span>
                                                @endforeach
                                            @endif
                                            </td>
                                            <td>
                                            <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>
                                            <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
                                                {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                {!! $data->render() !!}
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

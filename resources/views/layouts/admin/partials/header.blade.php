<div class="container-fluid no-gutters">
    <div class="row">
        <div class="col-lg-12 p-0 ">
            <div class="header_iner d-flex justify-content-between align-items-center">
                <div class="sidebar_icon d-lg-none">
                    <i class="ti-menu"></i>
                </div>
                <div class="serach_field-area d-flex align-items-center">

                </div>
                <div class="header_right d-flex justify-content-between align-items-center">

                    <div class="profile_info">
                        <img src="{{ asset('admin') }}/img/man.png" alt="#">
                        <div class="profile_info_iner">
                            <div class="profile_author_name text-center">
                            
                                <h5>{{ Auth::user()->name }}</h5>
                            </div>
                            <div class="profile_info_details text-center">
                                {{-- <a href="#">My Profile </a>
                                <a href="#">Settings</a>
                                <hr> --}}
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-light btn-sm"><img src="{{ asset('admin/img/icon/logout.svg') }}" alt=""> <strong>Log Out</strong></button>
                                </form>

                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

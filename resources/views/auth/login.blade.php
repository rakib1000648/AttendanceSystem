<!DOCTYPE html>
<html lang="zxx">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Master Fishing</title>

    @include('layouts.admin.partials.links')
</head>

<body class="crm_body_bg">

    <section>
        <!-- menu  -->
        <div class="container p-0">
            <br><br>
            <div class="col-lg-12">
                <div class="white_box mb_30">
                    <div class="row justify-content-center">

                        <div class="col-lg-8">
                            <!-- sign_in  -->
                            <div class="modal-content cs_modal">
                                <div class="modal-header justify-content-center " style="background-color:white;">
                                    {{-- <h5 class="modal-title text_white">Master Fishing</h5> --}}
                                    <a href="{{ url('/') }}"><img src="{{ asset('admin') }}/img/master_fishing_logo.png"
                                        style="" alt="master fishing"><br></a>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required autocomplete="email" autofocus
                                                placeholder="Email Address..">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" required autocomplete="current-password"
                                                placeholder="Password...">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <button type="submit" class="btn_1 full_width text-center">Log in</button>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.admin.partials.scripts')
</body>

</html>

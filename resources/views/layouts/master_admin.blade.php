<!DOCTYPE html>
<html lang="zxx">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Master Fishing</title>

    @include('layouts.admin.partials.links')
    @livewireStyles
</head>
<body class="crm_body_bg">



<!-- main content part here -->

@include('layouts.admin.partials.sidebar')
 <!--/ sidebar  -->


    @yield('content')
<!-- main content part end -->



<div id="back-top" style="display: none;">
    <a title="Go to Top" href="#">
        <i class="ti-angle-up"></i>
    </a>
</div>

<!-- footer  -->
@livewireScripts
@include('layouts.admin.partials.scripts')
</body>

<!-- Mirrored from demo.dashboardpack.com/sales-html/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 01 Feb 2022 11:00:49 GMT -->
</html>

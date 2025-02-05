<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Preskool - Bootstrap Admin Template">
    <meta name="keywords" content="admin, estimates, bootstrap, business, html5, responsive, Projects">
    <meta name="author" content="Dreams technologies - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title') | Lesedi Academy</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('backend/assets/img/favicon.png') }}">

    <script src="{{ asset('backend/assets/js/theme-script.js') }}" type="text/javascript"></script>

    <link rel="stylesheet" href="{{ asset('backend/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/plugins/icons/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/plugins/tabler-icons/tabler-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/plugins/owlcarousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/plugins/owlcarousel/owl.theme.default.min.css') }}">

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css">

    <link rel="stylesheet" href="{{ asset('backend/assets/css/style.css') }}">



</head>

<body>

<div class="main-wrapper">

    @include('admin.layouts.navigation')

   @include('admin.layouts.sidebar')

 @yield('content')

</div>


<script src="{{ asset('backend/assets/js/jquery-3.7.1.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/assets/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/assets/js/moment.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/assets/plugins/daterangepicker/daterangepicker.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/assets/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/assets/js/feather.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/assets/js/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/assets/plugins/apexchart/apexcharts.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/assets/plugins/apexchart/chart-data.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/assets/plugins/owlcarousel/owl.carousel.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/assets/plugins/select2/js/select2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/assets/plugins/countup/jquery.counterup.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/assets/plugins/countup/jquery.waypoints.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/assets/js/script.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/assets/static/rocket-loader.min.js') }}" defer></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.js"></script>


@stack('scripts')


<script>
    @if($errors->any())
    @foreach($errors->all() as $error)
    toastr.error("{{$error}}")
    @endforeach
    @endif
</script>

</body>

</html>

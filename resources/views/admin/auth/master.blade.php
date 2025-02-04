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

    <link rel="stylesheet" href="{{ asset('backend/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/plugins/icons/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/plugins/tabler-icons/tabler-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/style.css') }}">
</head>

<body class="account-page">

@yield('content')


<script src="{{ asset('backend/assets/js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/feather.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/script.js') }}"></script>

<script src="{{ asset('backend/7d0fa10a/cloudflare-static/rocket-loader.min.js') }}" data-cf-settings="b7851a59aa7a714fcec34d62-|49" defer></script>

@stack('scripts')


</body>

</html>

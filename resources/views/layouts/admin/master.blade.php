<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <!-- Twitter meta-->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="@pratikborsadiya">
    <meta property="twitter:creator" content="@pratikborsadiya">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Vali Admin">
    <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
    <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
    <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
    <meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('meta')
    @yield('style')
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body class="app sidebar-mini rtl">
<!-- Navbar-->
@include('admin/partials/header')
<!-- Sidebar menu-->
@include('admin/partials/sidebar')

{{--Content--}}
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa @yield('fa-class')">@yield('ionicon')</i> @yield('page')</h1>
            <p>@yield('description')</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">@yield('url')</a></li>
            @yield('breadcrumb')
        </ul>
    </div>
    @yield('content')
</main>

<script src="{{asset('js/admin/jquery.min.js')}}"></script>
<script src="{{asset('js/admin/popper.min.js')}}"></script>
<script src="{{asset('js/admin/bootstrap.min.js')}}"></script>
<script src="{{asset('js/admin/main.js')}}"></script>
<script src="{{asset('js/admin/plugins/pace.min.js')}}"></script>
<script src="https://unpkg.com/ionicons@4.3.0/dist/ionicons.js"></script>

@yield('script')
</body>
</html>
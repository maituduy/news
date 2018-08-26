<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('meta')
    @yield('style')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <style>
        .app-sidebar__toggle:before {
            content: "";
            font-size: 21px;
        }
    </style>
</head>
<body class="app sidebar-mini rtl">
<!-- Navbar-->
@include('admin.partials.header')
<!-- Sidebar menu-->
@include('admin.partials.sidebar')

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
@stack('script')
</body>
</html>
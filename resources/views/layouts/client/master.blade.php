<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BAO MOI</title>
    <!-- <meta name= "keywords" content="TNmobile, điện thoại chính hãng, smartphone,"> -->
    <!-- <meta name="description" content="Cửa hàng bán lẻ điện thoại di động, smartphone chính hãng mới nhất, giá tốt.">
    <meta content="INDEX,FOLLOW" name="robots">
    
    <meta property="og:title" content="TNmobile.com - Thế giới điện thoại chính hãng">
    <meta property="og:image" content="https://tnmobilecom.000webhostapp.com/image/Slide/ip6s-slide.png" alt="TNmobile">
    <meta property="og:description" content="Điện thoại di động, smartphone chính hãng mới nhất, giá tốt.">
    <meta property="og:site_name" content="TNmobile.com">
    <meta property="og:type" content="website">
    <meta name="copyright" content="Nhóm thực tập công ty Tâm Việt">
    <meta name="author" content="Nhóm thực tập công ty Tâm Việt">
    <meta property="og:locale" content="vi_VN">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('/css/client/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/css/client/reset.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- Latest compiled and minified CSS -->
    
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link rel="shortcut icon"  href="favicon.ico" sizes="16x16">
    @stack('style')
</head>
<body>
    <div class="wrapper">
        @include('client.partials.header')
        @include('client.partials.menu')
        @include('client.partials.slide')

        <div class="main clearfix">
            
            <div class="main_left ">
                @yield('content')
            </div>
            <div class="main_right">
                @include('client.partials.commercial')  
            </div>
        </div>

        <hr class="hr_center">
        @include('client.partials.footer')
         
    </div>
    @stack('script')
</body>
</html>
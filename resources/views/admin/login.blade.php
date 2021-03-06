<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <title>Login - Admin</title>
    <style>
        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus,
        input:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 30px white inset;
        }
    </style>
</head>
<body>
<section class="material-half-bg">
    <div class="cover"></div>
</section>
<section class="login-content">
    <div class="logo">
        <h1></h1>
    </div>
    <div class="login-box">
        
        <form class="login-form" method="post" action="{{action('Admin\AuthController@login')}}">
            {{csrf_field()}}
            <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>ĐĂNG NHẬP</h3>
            <div class="form-group">
                <label class="control-label">EMAIL</label>
                <input class="form-control" type="text" placeholder="Email" name="email" value="{{old('email')}}" autofocus required>
            </div>
            <div class="form-group">
                <label class="control-label">MẬT KHẨU</label>
                <input class="form-control" type="password" placeholder="Password" name="password" required>
            </div>
            <div class="form-group">
                <div class="utility">
                    <div class="animated-checkbox">
                        <label>
                            <input type="checkbox"><span class="label-text">Giữ Đăng nhập</span>
                        </label>
                    </div>
                    <p class="semibold-text mb-2"><a href="#" data-toggle="flip">Quên Mật Khẩu</a></p>
                </div>
            </div>
            <div class="form-group btn-container">
                <button class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>Đăng nhập</button>
            </div>
        </form>
        <form class="forget-form" method="post" action="">
            {{csrf_field()}}
            <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>Forgot Password ?</h3>
            <div class="form-group">
                <label class="control-label">EMAIL</label>
                <input class="form-control" type="text" placeholder="Email">
            </div>
            <div class="form-group btn-container">
                <button class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>RESET</button>
            </div>
            <div class="form-group mt-3">
                <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> Back to Login</a></p>
            </div>
        </form>
    </div>
</section>

<script src="{{asset('js/admin/jquery.min.js')}}"></script>
<script src="{{asset('js/admin/popper.min.js')}}"></script>
<script src="{{asset('js/admin/bootstrap.min.js')}}"></script>
<script src="{{asset('js/admin/main.js')}}"></script>
<script src="{{asset('js/admin/plugins/pace.min.js')}}"></script>

<script>

    $('.login-content [data-toggle="flip"]').click(function() {
        $('.login-box').toggleClass('flipped');
        return false;
    });

</script>
</body>
</html>
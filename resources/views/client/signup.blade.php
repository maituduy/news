@extends('layouts.client.master')

@section('content')
<div class="signup">
    <form method="post" action="{{ url('/signup') }}" style="border:1px solid #ccc">
        {{ csrf_field() }}
        <div class="signup_layout">
            <h1>Đăng kí</h1>
            <hr class="login_hr">
            
            <div class="form-group">
                <label for="fullname"><b>Họ Và Tên</b></label>
                <input type="text" class="form-control {{($errors->has('name')) ? 'is-invalid' : ''}}" name="name" value="{{ old('name') }}">
                @if($errors->has('name'))
                    <div class="invalid-feedback">{{ $errors->first('name')}}</div>
                @endif
            </div>
            <div class="form-group">
                <label for="email"><b>Email</b></label>
                <input type="text" class="form-control {{($errors->has('email')) ? 'is-invalid' : ''}}" name="email" value="{{ old('email') }}">        
                @if($errors->has('email'))
                    <div class="invalid-feedback">{{$errors->first('email')}}</div>
                @endif
            </div>
            <div class="form-group">
                <label for="password"><b>Mật Khẩu</b></label>
                <input type="password" class="{{($errors->has('password')) ? 'is-invalid' : ''}} form-control" name="password">
                @if($errors->has('password'))
                    <div class="invalid-feedback">{{$errors->first('password')}}</div>
                @endif
            </div>
            <div class="form-group">
                <label for="password_confirmation"><b>Nhập lại mật khẩu</b></label>
                <input type="password" class="form-control" name="password_confirmation">      
            </div>
            
            <div class="clearfix">
                <button type="submit" class="signupbtn">Đăng kí</button>
            </div>
        </div>
    </form>
</div>
@endsection
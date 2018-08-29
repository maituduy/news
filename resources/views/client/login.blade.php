@extends('layouts.client.master')

@section('content')
<div class="login">
  <form action="{{ url('/login') }}" method="post" style="border:1px solid #ccc">
      {{ csrf_field() }}
      
    <div class="login_layout">
      <h1 style="text-align: center">Đăng nhập</h1>
      @if (session('msg'))
          <div class="alert alert-danger">
              {{ session('msg') }}
          </div>
      @endif
      <hr class="login_hr">
  
      <label for="fullname"><b>Email</b></label>
      <input type="text" placeholder="Nhập tên tài khoản" name="email" required>
  
      
      <label for="psw"><b>Mật Khẩu</b></label>
      <input type="password" placeholder="Nhập mật khẩu" name="password" required>
      
      <div class="clearfix">
        <button type="submit" class="signupbtn">Đăng Nhập</button>
      </div>
    </div>
  </form>
</div>
@endsection
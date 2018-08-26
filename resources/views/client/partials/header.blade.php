<div class="header">
    <div class="header_center clearfix">
        <div class="header_left">
            <img class="logo_image" src="{{ asset('/images/client/baomoi.png') }}" alt="logo trang bao">
        </div>
        <div class="header_right">
            @if (!auth()->check())
                <a href="{{ url('/login') }}" style="line-height:50px">Đăng Nhập</a>
                <a href="{{ url('/signup') }}" style="line-height:50px">Đăng Ký</a>
            @else
                <a href="{{ route('logout') }}" style="line-height:50px">Đăng Xuất</a>
            @endif
            
        </div>
    </div>
</div>
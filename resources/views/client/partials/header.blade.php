<div class="header">
    <div class="header_center clearfix d-flex">
        <div class="header_left">
            <img class="logo_image" src="{{ asset('/images/client/baomoi.png') }}" alt="logo trang bao">
        </div>
        <div class="flex-grow-1 ">
            <div class="row">
                <div class="col-md-6 mx-auto mt-2">
                    <form action="{{ url('/search') }}" class="input-group mb-3 pl-2 pr-2" method="get">
                        <input type="text" class="form-control" required name="search">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary">Tìm Kiếm</button>
                        </div>
                    </form>
                    
                </div>
            </div>
            
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
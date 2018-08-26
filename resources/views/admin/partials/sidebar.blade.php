<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="{{ asset(auth()->user()->avatar) }}" alt="User Image">
        <div>
            <p class="app-sidebar__user-name">{{auth()->user()->name}}</p>
            <p class="app-sidebar__user-designation">{{ucwords(auth()->user()->job->name)}}</p>
        </div>
    </div>
    <ul class="app-menu">
        <li><a class="app-menu__item @yield('dashboard')" href="{{route('admin_dashboard')}}" ><i class="app-menu__icon fas fa-tachometer-alt"></i><span class="app-menu__label">Bảng Điều Khiển</span></a></li>
        <li><a class="app-menu__item @yield('users')" href="{{route('users.index')}}"><i class="app-menu__icon fa fa-user"></i><span class="app-menu__label">Người dùng</span></a></li>
        <li><a class="app-menu__item @yield('categories')" href="{{route('categories.index')}}"><i class="app-menu__icon fa
        fa-list-alt"></i><span class="app-menu__label">Chuyên mục</span></a></li>
        {{-- <li><a class="app-menu__item @yield('employees')" href="{{route('employees.index')}}"><i class="app-menu__icon fas fa-user-tie" ></i><span
                        class="app-menu__label">Nhân viên</span></a></li> --}}
        <li><a class="app-menu__item @yield('stories')" href="{{ route('stories.index') }}"><i class="app-menu__icon fas fa-newspaper" ></i><span class="app-menu__label">Bài viết</span></a></li>
    </ul>
</aside>
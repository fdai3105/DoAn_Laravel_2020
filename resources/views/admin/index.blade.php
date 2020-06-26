@extends('layouts.master')
<title>Admin Panel</title>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- left panel -->
            <div class="col-sm-2 sidenav">
                <!-- user header -->
                <a href="" style="text-decoration: none">
                    <div class="user-details">
                        <img src="https://www.w3schools.com/howto/img_avatar.png" style="border-radius: 50%;width: 20%">
                        <p>{{Auth::user()->name}}</p>
                    </div>
                </a>
                <div class="list-group">
                    <a href="{{route('index')}}" class="list-group-item {{Route::currentRouteName() == 'index' ? 'active' : ''}}">Bảng điều khiển</a>
                    <a href="{{route('products.index')}}" class="list-group-item {{Route::currentRouteName() == 'products.index' ? 'active' : ''}}">Sản Phẩm</a>
                    <a href="{{route('brands.index')}}" class="list-group-item {{Route::currentRouteName() == 'brands.index' ? 'active' : ''}}">Thương Hiệu</a>
                    <a href="{{route('categories.index')}}" class="list-group-item {{Route::currentRouteName() == 'categories.index' ? 'active' : ''}}">Danh Mục</a>
                    <a href="" class="list-group-item {{Route::currentRouteName() == 'categories.index' ? 'active' : ''}}">Người Dùng</a>

                    <a href="{{route('getLogout')}}" class="list-group-item" style="margin-top: 35vh"><i class="fa fa-arrow-left"></i> Đăng xuất</a>
                    <a href="/" class="list-group-item"><i class="fa fa-arrow-left"></i> Back to Home</a>
                </div>
            </div>
            @yield('content')
        </div>
    </div>
</body>
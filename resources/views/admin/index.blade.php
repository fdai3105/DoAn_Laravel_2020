@extends('layouts.master')

<head>
    <title>Admin Panel</title>

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- left panel -->
            <div class="col-sm-2 sidenav">
                <!-- user header -->
                <a href="" style="text-decoration: none">
                    <div class="user-details">
                        <img src="https://www.w3schools.com/howto/img_avatar.png" style="border-radius: 50%;width: 20%">
                        <p>{{Auth::user()->email}}</p>
                    </div>
                </a>
                <div class="list-group">
                    <p>a::{{Session::get('website_language')}}</p>
                    <a href="{{route('index')}}" class="list-group-item {{Route::currentRouteName() == 'index' ? 'active' : ''}}">{{trans('admin.dashboard')}}</a>
                    <a href="{{route('products.index')}}" class="list-group-item {{Route::currentRouteName() == 'products.index' ? 'active' : ''}}">{{trans('admin.product')}}</a>
                    <a href="{{route('brands.index')}}" class="list-group-item {{Route::currentRouteName() == 'brands.index' ? 'active' : ''}}">{{trans('brand')}}</a>
                    <a href="{{route('categories.index')}}" class="list-group-item {{Route::currentRouteName() == 'categories.index' ? 'active' : ''}}">{{trans('admin.category')}}</a>
                    <a href="{{route('users.index')}}" class="list-group-item {{Route::currentRouteName() == 'users.index' ? 'active' : ''}}">{{trans('admin.user')}}</a>
                    <a href="{{route('order.index')}}" class="list-group-item {{Route::currentRouteName() == 'order.index' || Route::currentRouteName() == 'order.show' ? 'active' : ''}}">{{trans('admin.order')}}</a>
                    <a href="{{route('getLogout')}}" class="list-group-item" style="margin-top: 30vh"><i class="fa fa-arrow-left"></i> {{trans('admin.logout')}}</a>
                    <a href="/" class="list-group-item"><i class="fa fa-arrow-left"></i> {{trans('admin.backToHome')}}</a>
                </div>
            </div>
            @yield('content')
        </div>
    </div>
</body>
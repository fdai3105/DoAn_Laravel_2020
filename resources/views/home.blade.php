@extends('layouts.master')

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/">FDai Store</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/">Trang Chủ
                    <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Danh Mục
                </a>

                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    @foreach($categoriesData as $categoriesData)
                    <a class="dropdown-item" href="{{route('category',$categoriesData->name)}}">{{$categoriesData->name}}</a>
                    @endforeach
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Thương Hiệu
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    @foreach($brandsData as $brandsData)
                    <a class="dropdown-item" href="{{route('brand',$brandsData->name)}}">{{$brandsData->name}}</a>
                    @endforeach
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Thông Tin</a>
            </li>
        </ul>
    </div>
    <form class="form-inline" action="{{route('search')}}" method="get" style="margin-bottom: 0px;">
        <input class="form-control mr-sm-2" name="key" type="search" placeholder="Tìm Sản Phẩm..." aria-label="Search" required oninvalid="this.setCustomValidity('Không được để trống')" oninput="setCustomValidity('')"></input>
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
</nav>

@yield('body')

@include('layouts.footer')
@extends('layouts.master')

<div class="container-fluid">
    <div class="row">
        <!-- left panel -->
        <div class="col-sm-2 sidenav">
            <!-- user header -->
            <a href="" style="text-decoration: none">
                <div class="user-details">
                    <img src="https://www.w3schools.com/howto/img_avatar.png" style="border-radius: 50%;width: 20%">
                    <p>Hoàng Phi Đại</p>
                </div>
            </a>

            <!-- list item -->
            <div class="list-group">
                <a href="{{ route('admin') }}" class="list-group-item">Sản Phẩm</a>
                <a href="{{ route('admin/brand') }}" class="list-group-item active">Danh Mục</a>
                <a href="{{ route('admin/user') }}" class="list-group-item">Third item</a>

                <a href="/" class="list-group-item" style="margin-top: 59vh"><i class="fa fa-arrow-left"></i> Back to Home</a>
            </div>
        </div>

        <!-- right panel -->
        <div class="col-sm-10" style="background-color:white;margin-left: 16.5%">

        </div>
    </div>
</div>
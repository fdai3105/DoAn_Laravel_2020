@extends('admin.index')

<head>
    <title>Chi Tiết Đơn Hàng | Admin Panel</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
</head>
<style>
    h5,
    p,
    td,
    th {
        color: #585858 !important;
    }

    .row {
        width: 100%;
    }

    .col-5 {
        padding-right: 0px !important;

    }

    li {
        list-style-type: circle;
        list-style-position: inside;
    }
</style>
@section('content')
<div class="col-sm-10">
    <!-- header -->
    <nav class="shadow-sm" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin"><i class="fa fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/admin/order">Orders</a></li>
            <li class="breadcrumb-item active" aria-current="page">Order Detail</li>
        </ol>
    </nav>

    <div class="row row-padding">
        <div class="col-lg-4 shadow" style="border-radius: 20px;background-color:white; padding: 20px;">
            <h5 style="text-align:center">Thông tin khách hàng</h5>
            <hr>
            <div class="row" style="margin:0;">
                <div class="row">
                    <p class="col-5">Họ tên:</p>
                    <p class="col weight-500">{{$orderData->user->fullname}}</p>
                </div>
                <div class="row">
                    <p class="col-5">Số điện thoại:</p>
                    <p class="col weight-500">{{$orderData->user->phone}}</p>
                </div>
                <div class="row">
                    <p class="col-5">Tình trạng:</p>
                    <div class="col">
                        @switch($orderData->status)
                        @case('Pending')
                        <th style="text-align:center"><span class="badge badge-secondary pill">Pending</span></th>
                        @break

                        @case('Delivery')
                        <th style="text-align:center"><span class="badge badge-warning pill">Delivery</span></th>
                        @break

                        @case('Complete')
                        <th style="text-align:center"><span class="badge badge-success pill">Complete</span></th>
                        @break

                        @case('Cancel')
                        <th style="text-align:center"><span class="badge badge-danger pill">Cancel</span></th>
                        @break
                        @endswitch
                    </div>
                </div>
                <div class="row">
                    <p class="col-5">Email:</p>
                    <p class="col weight-500">{{$orderData->user->email}}</p>
                </div>
                <div class="row">
                    <p class="col-5">Địa chỉ:</p>
                    <ul class="col weight-500">
                        @if ($orderData->user->address)
                        <li>{{$orderData->user->address->city}}</li>
                        <li>{{$orderData->user->address->district}}</li>
                        <li>{{$orderData->user->address->ward}}</li>
                        <li>{{$orderData->user->address->street}}</li>
                        @endif
                    </ul>
                </div>
                <div class="row">
                    <p class="col-5">Ghi chú:</p>
                    <p class="col weight-500">{{$orderData->note}}</p>
                </div>
                <div class="row">
                    <p class="col-5">Ngày đặt:</p>
                    <p class="col-lg-7 weight-500">{{$orderData->created_at}}</p>
                </div>
            </div>
        </div>

        <div class="col-lg-7 shadow" style="border-radius: 20px;background-color:white; padding: 20px;">
            <h5>Chi tiết đơn hàng</h5>
            <hr>
            <table class="table table-borderless table-hover">
                <thead>
                    <tr>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Đơn giá</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orderData->orderDetails as $orderDetail)
                    <tr>
                        <td>{{$orderDetail->product->name}}</td>
                        <td>{{number_format($orderDetail->product->price)}} VNĐ</td>
                        <td>{{$orderDetail->quality}}</td>
                        <td>{{number_format($orderDetail->price)}} VNĐ</td>
                    </tr>
                    @endforeach
                    <tr style="border-top: 1px solid #dbdbdb;">
                        <th colspan="3">Tổng tiền: </th>
                        <td>{{number_format($orderData->total)}} VNĐ</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row-padding" style="margin-left: 33px;margin-right: 33px;">
        <div class="shadow" style="border-radius: 20px;background-color:white; padding: 20px;">
            <h5>Timeline</h5>
            <hr>
        </div>
    </div>
</div>
@endsection
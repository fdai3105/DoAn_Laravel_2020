@extends('admin.index')

<head>
    <title>Đơn Hàng | Admin Panel</title>
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
</style>
@section('content')
<div class="col-sm-10">
    <!-- header -->
    <nav class="shadow-sm" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin"><i class="fa fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Orders</li>
        </ol>
    </nav>

    <!-- table -->
    <div class="shadow" style="margin-left: 20px;margin-right: 20px; border-radius: 20px;background-color:white; padding: 20px;margin-bottom: 20px;">
        <h5>{{$ordersData->count()}} Order</h5>
        <table class="table table-borderless" id="brandTable">
            <thead>
                <tr style="border-bottom: 1px solid #dbdbdb;">
                    <th scope="col">ID</th>
                    <th scope="col">Người đặt hàng</th>
                    <th scope="col">Tổng Tiền</th>
                    <th scope="col">Ghi chú</th>
                    <th scope="col">Ngày Đặt</th>
                    <th scope="col" style="text-align:center">Trạng Thái</th>
                    <th scope="col" style="width: 10%; text-align:center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ordersData as $orderData)
                <tr>
                    <td>{{$orderData->id}}</td>
                    <td>{{$orderData->user->name}}</td>
                    <td>{{number_format($orderData->total)}} VND</td>
                    <td>{{$orderData->note}}</td>
                    <td>{{$orderData->created_at}}</td>
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
                    <td style="text-align:center"><a class="btn btn-primary" href="{{route('order.show', $orderData->id)}}">Chi tiết</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
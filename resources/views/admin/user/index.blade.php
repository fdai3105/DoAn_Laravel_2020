@extends('admin.index')

<head>
    <title>Người Dùng | Admin Panel</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
</head>

@section('content')
<div class="col-sm-10">
    <!-- header -->
    <nav class="shadow-sm" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin"><i class="fa fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Users</li>
        </ol>
    </nav>

    <!-- table -->
    <div class="shadow" style="margin-left: 20px;margin-right: 20px; border-radius: 20px;background-color:white; padding: 20px;margin-bottom: 20px;">
        <h5>{{count($usersData)}} Users</h5>
        <table class="table table-borderless" id="brandTable">
            <thead>
                <tr style="border-bottom: 1px solid #dbdbdb;">
                    <th>ID</th>
                    <th>Tên người dùng</th>
                    <th>Email người dùng</th>
                    <th>Cấp</th>
                    <th>Địa chỉ</th>
                    <th>Ngày Thêm</th>
                    <th style="width: 10%; text-align:end">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usersData as $usersData)
                <tr>
                    <td>{{$usersData->id}}</td>
                    <td>{{$usersData->name}}</td>
                    <td>{{$usersData->email}}</td>
                    <td>@switch($usersData->level)
                        @case(1)
                        Admin
                        @break

                        @case(2)
                        User
                        @break

                        @default
                        null
                        @endswitch
                    </td>
                    <td>{{$usersData->address->city}} -
                        {{$usersData->address->district}} <br>
                        {{$usersData->address->ward}} <br>
                        {{$usersData->address->street}}
                    </td>
                    <td>{{$usersData->created_at}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
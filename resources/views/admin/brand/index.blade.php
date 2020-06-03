@extends('admin.index')

@section('content')
<div class="col-sm-10" style="background-color:white;margin-left: 16.69%; padding: 0px;">
    <!-- header -->
    <div class="container-fluid">
        <div class="row header">
            <div class="col-2" style="display:flex">
                <img src="https://img.icons8.com/material/24/ffffff/branding.png" />
                <h5 style="vertical-align:middle">Brands</h5>
            </div>
            <div class="col-10" style="text-align: end;">
                <h5>{{$brandsData->count()}} Items</h5>
            </div>
        </div>
    </div>

    <!-- sub-header -->
    <div class="row sub-header">
        <!-- add modal -->
        <div class="col-12 right">
            <button type="btn" class="btn btn-info btn-lg" data-toggle="modal" data-target="#addModal">
                <i class="fa fa-plus"></i> Thêm Hãng
            </button>

            <!-- add modal -->
            @include('admin.brand.partials.add_modal')
        </div>
    </div>

    <!-- display errors -->
    @include('common.errors')

    <!-- table -->
    <table class="table table-hover">
        <thead>
            <tr class="bg-primary">
                <th>ID</th>
                <th>Tên sản phẩm</th>
                <th>Ngày Thêm</th>
                <th>Ngày Sửa</th>
                <th style="width: 10%; text-align:end">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($brandsData as $brandsData)
            <tr>
                <td>{{$brandsData->id}}</td>
                <td>{{$brandsData->name}}</td>
                <td>{{$brandsData->created_at}}</td>
                <td>{{$brandsData->updated_at}}</td>
                <td>
                    <div class="row action-button">
                        <!-- edit button -->
                        <div class="action-edit">
                            <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#editBrandModal{{$brandsData->id}}">
                                <i class="fa fa-btn fa-edit"></i> Sửa
                            </button>

                            <!-- edit modal -->
                            @include('admin.brand.partials.edit_modal')
                        </div>

                        <!-- delete button -->
                        <div class="action-delete">
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delModal{{$brandsData->id}}">
                                <i class="fa fa-btn fa-trash"></i> Delete
                            </button>

                            <!-- del modal -->
                            @include('admin.brand.partials.del_modal')
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
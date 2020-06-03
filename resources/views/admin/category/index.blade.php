@extends('admin.index')

@section('content')
<div class="col-sm-10" style="background-color:white;margin-left: 16.69%; padding: 0;">
    <!-- header -->
    <div class="container-fluid">
        <div class="row header">
            <div class="col-2" style="display:flex">
                <img src="https://img.icons8.com/material/24/ffffff/sorting-answers--v1.png" />
                <h5 style="vertical-align:middle">Products</h5>
            </div>
            <div class="col-10" style="text-align: end;">
                <h5>{{$categoriesData->count()}} Items</h5>
            </div>
        </div>
    </div>

    <!-- sub-header -->
    <div class="row sub-header">
        <!-- add Modal -->
        <div class="col-12 right">
            <button type="btn" class="btn btn-info btn-lg" data-toggle="modal" data-target="#addModal">
                <i class="fa fa-plus"></i> Thêm Danh Mục
            </button>

            <!-- add modal -->
            @include('admin.category.partials.add_modal')
        </div>
    </div>

    <!-- display errors -->
    @include('common.errors')

    <!-- table -->
    <table class="table table-hover">
        <thead>
            <tr class="bg-primary">
                <th>ID</th>
                <th>Tên Danh Mục</th>
                <th>Ngày Thêm</th>
                <th>Lần Sửa</th>
                <th style="width: 10%;text-align:end">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categoriesData as $categoriesData)
            <tr>
                <td>{{$categoriesData->id}}</td>
                <td>{{$categoriesData->name}}</td>
                <td>{{$categoriesData->created_at}}</td>
                <td>{{$categoriesData->updated_at}}</td>
                <td>
                    <div class="row action-button">
                        <!-- edit button -->
                        <div class="action-edit">
                            <button type="submit" class="btn btn-primary edit" data-toggle="modal" data-target="#editModal{{$categoriesData->id}}">
                                <i class="fa fa-btn fa-edit"></i> Edit
                            </button>

                            <!-- edit modal -->
                            @include('admin.category.partials.edit_modal')
                        </div>

                        <!-- delete button -->
                        <div class="action-delete">
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delModal{{$categoriesData->id}}">
                                <i class="fa fa-btn fa-trash"></i> Delete
                            </button>

                            <!-- del modal -->
                            @include('admin.category.partials.del_modal')
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
@extends('layouts.admin')

@section('content')
<div>
    <div class="row">
        <div class="col-lg-6">
            <br>
            <h4>{{$productsData->count()}} Sản Phẩm</h4>
        </div>

        <!-- add modal -->
        <div class="col-lg-6 right">
            <div style="margin-top:20px">
                <button type="btn" class="btn btn-info btn-lg" data-toggle="modal" data-target="#addModal">
                    <i class="fa fa-plus"></i> Thêm Product
                </button>
            </div>

            <!-- add modal -->
            @include('admin.product.partials.add_modal')
        </div>
    </div>

    <br>
    @include('common.errors')

    <!-- table -->
    <table class="table table-hover">
        <thead>
            <tr class="bg-primary">
                <th>ID</th>
                <th style="width: 12%">Tên sản phẩm</th>
                <th style="width: 12%">Mô tả</th>
                <th>Ảnh</th>
                <th>Giá</th>
                <th>Thương Hiệu</th>
                <th>Danh Mục</th>
                <th>Ngày thêm</th>
                <th>Ngày sửa</th>
                <th style="width: 10%;text-align:end">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productsData as $productsData)
            <tr>
                <td>{{$productsData->id}}</td>
                <td>{{$productsData->name}}</td>
                <td data-toggle="tooltip" data-placement="bottom" title="{{$productsData->desc}}">{{Str::limit($productsData->desc,30)}}</td>
                <td>{{Str::limit($productsData->image,20)}}</td>
                <td>{{$productsData->price}}</td>
                <td>{{$productsData->productBrand->name}}</td>
                <td>{{$productsData->category->name}}</td>
                <td>{{$productsData->created_at}}</td>
                <td>{{$productsData->updated_at}}</td>
                <td>
                    <div class="row action-button">
                        <!-- edit button -->
                        <div class="action-edit">
                            <button type="submit" class="btn btn-primary edit" data-toggle="modal" data-target="#editModal{{$productsData->id}}">
                                <i class="fa fa-btn fa-edit"></i> Edit
                            </button>

                            <!-- edit modal -->
                            @include('admin.product.partials.edit_modal')
                        </div>

                        <!-- delete button -->
                        <div class="action-delete">
                            <form action="{{ route('products.destroy',$productsData->id) }}" class="action-form" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-btn fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
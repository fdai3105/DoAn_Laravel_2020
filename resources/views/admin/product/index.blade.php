@extends('admin.index')

<head>
    <title>Sản Phẩm | Admin Panel</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
</head>

@section('content')
<div class="col-sm-10">
    <!-- header -->
    <nav class="shadow-sm" aria-label="breadcrumb">
        <ol class="breadcrumb align-items-center">
            <li class="breadcrumb-item"><a href="/admin"><i class="fa fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Categories</li>
            <li class="ml-auto active" aria-current="page">
                <button type="btn" id="productModalAddBtn" data-target="#productAddModal" data-toggle="modal" class="btn btn-info btn-lg">
                    <i class="fa fa-plus" style="color:white !important"></i> Thêm Product
                </button>
            </li>
        </ol>
    </nav>

    <!-- display errors -->
    @include('common.errors')
    @include('admin.product.partials.add_modal')
    @include('admin.product.partials.edit_modal')
    @include('admin.product.partials.del_modal')

    <!-- table -->
    <div class="shadow" style="margin-left: 20px;margin-right: 20px; border-radius: 20px;background-color:white; padding: 20px;margin-bottom: 20px;">
        <h5>{{count($productsData)}} Sản phẩm</h5>

        <table class="table table-borderless" id="productTable">
            <thead>
                <tr style="border-bottom: 1px solid #dbdbdb">
                    <th scope="col">ID</th>
                    <th scope="col">Tên sản phẩm</th>
                    <th scope="col">Mô tả</th>
                    <th v>Ảnh</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Thương Hiệu</th>
                    <th scope="col">Danh Mục</th>
                    <th scope="col">Ngày thêm</th>
                    <th scope="col">Ngày sửa</th>
                    <th scope="col" style="text-align:end">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productsData as $productsData)
                <tr>
                    <th scope="row" style="color:#585858">{{$productsData->id}}</td>
                    <td>{{$productsData->name}}</td>
                    <td data-toggle="tooltip" data-placement="bottom" title="{{$productsData->desc}}">{{Str::limit($productsData->desc,30)}}</td>
                    <td><a href="{{$productsData->image}}" target="_blank">{{Str::limit($productsData->image,20)}}</a></td>
                    <td>{{number_format($productsData->price,0,'.','.',)}}</td>
                    <td>{{$productsData->productBrands->name}}</td>
                    <td>{{$productsData->categories->name}}</td>
                    <td>{{$productsData->created_at}}</td>
                    <td>{{$productsData->updated_at}}</td>
                    <td>
                        <div class="row action-button">
                            <!-- edit button -->
                            <div class="action-edit">
                                <button type="submit" id="productModalEditBtn" data-id="{{$productsData->id}}" class="btn btn-primary edit">
                                    <i class="fa fa-btn fa-edit"></i> Sửa
                                </button>
                            </div>

                            <!-- delete button -->
                            <div class="action-delete">
                                <button type="button" id="productModalDelBtn" data-id="{{$productsData->id}}" class="btn btn-danger">
                                    <i class="fa fa-btn fa-trash"></i> Xoá
                                </button>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //region dataTable
        $('#productTable').DataTable({
            "paging": false,
            "info": false,
            'order': [
                [0, 'asc'],
            ],
            "columnDefs": [{
                "orderable": false,
                "targets": 9
            }]
        });
        // style dataTable
        // header
        // $("#productTable").removeClass("dataTable")
        $("#productTable_filter").addClass("col-12")
        $('#productTable_filter').find("input").addClass("form-control form-control-sm");
        //endregion

        //region add brand
        //show dialog ADD modal by data-target on button tag
        $('#productModalAddBtn').on('click', function() {
            // get and set data to select box
            $.get('brandsDisplay', function(data) {
                $list = '';
                data.forEach(element => {
                    $list += '<option value="' + element.id + '">' + element.name + '</option>';
                });
                $('#productSelectBrand').html($list);
            })
            $.get('categoriesDisplay', function(data) {
                $list = '';
                data.forEach(element => {
                    $list += '<option value="' + element.id + '">' + element.name + '</option>';
                });
                $('#productSelectCate').html($list);
            })
        })
        var productInputName = $("#productInputName");
        var productInputDesc = $("#productInputDesc");
        var productInputImage = $("#productInputImage");
        var productInputPrice = $("#productInputPrice");
        var productInputRating = $("#productInputRating");
        // remove red alert on input box
        productInputName.on('keyup', function() {
            productInputName.removeClass("is-invalid");
        })
        productInputDesc.on('keyup', function() {
            productInputDesc.removeClass("is-invalid");

        })
        productInputImage.on('keyup', function() {
            productInputImage.removeClass("is-invalid");

        })
        productInputRating.on('keyup', function() {
            productInputRating.removeClass("is-invalid");
        })
        productInputPrice.on('keyup', function() {
            productInputPrice.removeClass("is-invalid");

        })

        $("#brandAddSubmit").click(function(e) {
            e.preventDefault();
            if (productInputName.val() == '' || productInputDesc.val() == '' ||
                productInputImage.val() == '' || productInputPrice.val() == '' || productInputRating.val() == '') {
                if (productInputName.val() == '') {
                    productInputName.addClass("is-invalid");
                }
                if (productInputDesc.val() == '') {
                    productInputDesc.addClass("is-invalid");
                }
                if (productInputImage.val() == '') {
                    productInputImage.addClass("is-invalid");
                }
                if (productInputRating.val() == '') {
                    productInputRating.addClass("is-invalid");
                }
                if (productInputPrice.val() == '') {
                    productInputPrice.addClass("is-invalid");
                }
                return false;
            }
            $.ajax({
                type: 'POST',
                url: '{{route("products.store")}}',
                data: $('#addProductForm').serialize(),
                success: function(data) {
                    location.reload();
                    console.log('Add product ajax: ' + JSON.stringify(data));
                },
                error: function(data) {
                    alert(JSON.stringify(data));
                }
            })
        })
        //endregion

        //region edit product
        // show edit modal
        $('#productEditInputName').on('keyup', function() {
            $('#productEditInputName').removeClass("is-invalid");
        })
        $('#productEditInputDesc').on('keyup', function() {
            $('#productEditInputDesc').removeClass("is-invalid");

        })
        $('#productEditInputImage').on('keyup', function() {
            $('#productEditInputImage').removeClass("is-invalid");

        })
        $('#productEditInputRating').on('keyup', function() {
            $('#productEditInputRating').removeClass("is-invalid");
        })
        $('#productEditInputPrice').on('keyup', function() {
            $('#productEditInputPrice').removeClass("is-invalid");

        })
        $("button[id='productModalEditBtn']").on('click', function() {
            var id = $(this).data("id");
            $.get("products/" + id + "/edit", function(data) {
                $('#productEditModal').modal('show');
                $('#editModalTitle').html('Sửa ' + data.name + '?');
                $('#productEditInputName').val(data.name);
                $('#productEditInputDesc').val(data.desc);
                $('#productEditInputImage').val(data.image);
                $('#productEditInputRating').val(data.vote);
                $('#productEditInputPrice').val(data.price);
                $('#productEditSubmit').data('id', id);
                // get and set data to select box
                $.get('brandsDisplay', function(data2) {
                    $list = '';
                    data2.forEach(element => {
                        $list += '<option value="' + element.id + '"' + ((element.id == data.product_brands_id) ? 'selected' : '') + '>' + element.name + '</option>';
                    });
                    $('#productEditSelectBrand').html($list);
                })
                $.get('categoriesDisplay', function(data3) {
                    $list = '';
                    data3.forEach(element => {
                        $list += '<option value="' + element.id + '"' + ((element.id == data.categories_id) ? 'selected' : '') + '>' + element.name + '</option>';
                    });
                    $('#productEditSelectCate').html($list);
                })
            })
        });
        // edit action
        $("button[id='productEditSubmit']").click(function(e) {
            e.preventDefault();
            var id = $(this).data("id");

            if ($('#productEditInputName').val() == '' || $('#productEditInputDesc').val() == '' ||
                $('#productEditInputImage').val() == '' || $('#productEditInputRating').val() == '' ||
                $('#productEditInputPrice').val() == '') {
                if ($('#productEditInputName').val() == '') {
                    $('#productEditInputName').addClass("is-invalid");
                }
                if ($('#productEditInputDesc').val() == '') {
                    $('#productEditInputDesc').addClass("is-invalid");
                }
                if ($('#productEditInputImage').val() == '') {
                    $('#productEditInputImage').addClass("is-invalid");
                }
                if ($('#productEditInputRating').val() == '') {
                    $('#productEditInputRating').addClass("is-invalid");
                }
                if ($('#productEditInputPrice').val() == '') {
                    $('#productEditInputPrice').addClass("is-invalid");
                }
                return false;
            }

            $.ajax({
                type: 'POST',
                url: 'products/' + id,
                data: $('#editModalProductForm').serialize(),
                success: function(data) {
                    $('#productEditModal').modal('hide');
                    location.reload();
                    console.log('Edit products ajax: ' + JSON.stringify(data));
                },
                error: function(data) {
                    alert(JSON.stringify(data));
                }
            })
        })
        //endregion

        //region del brand
        // show del mođal
        $("button[id='productModalDelBtn']").click(function() {
            var id = $(this).data("id");
            $.get("products/" + id, function(data) {
                $('#productDelModal').modal('show');
                $('#productDelModalTitle').html('Xoá ' + data.name + '?');
                $('#productDelSubmit').data('id', id);
                $('#countPro').html('Bạn có muốn xoá ' + data.name + '?');
            })
        });
        // del action
        $("button[id='productDelSubmit']").click(function(e) {
            e.preventDefault();
            var id = $(this).data("id");
            $.ajax({
                type: 'DELETE',
                url: 'products/' + id,
                success: function(data) {
                    $('#productDelModal').modal('hide');
                    location.reload();
                    console.log('Delete product ajax: ' + JSON.stringify(data));
                },
                error: function(data) {
                    alert(JSON.stringify(data));
                }
            })
        });
        //endregion
    })
</script>
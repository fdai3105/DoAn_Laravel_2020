@extends('admin.index')

<head>
    <title>{{trans('admin.titleProduct')}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
</head>
@section('content')
<div class="col-sm-10">
    <!-- header -->
    <nav class="shadow-sm" aria-label="breadcrumb">
        <ol class="breadcrumb align-items-center">
            <li class="breadcrumb-item"><a href="/admin"><i class="fa fa-home"></i> {{trans('admin.dashboard')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{trans('admin.product')}}</li>
            <li class="ml-auto active" aria-current="page">
                <button type="btn" id="productModalAddBtn" data-target="#productAddModal" data-toggle="modal" class="btn btn-info btn-lg">
                    <i class="fa fa-plus" style="color:white !important"></i> {{trans('admin.addProduct')}}
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
        <h5>{{count($productsData)}} {{trans('admin.product')}}</h5>

        <table class="table table-borderless table-hover" id="productTable">
            <thead>
                <tr style="border-bottom: 1px solid #dbdbdb">
                    <th scope="col">{{trans('admin.idProduct')}}</th>
                    <th scope="col">{{trans('admin.nameProduct')}}</th>
                    <th scope="col">{{trans('admin.descProduct')}}</th>
                    <th scope="col">{{trans('admin.imgProduct')}}</th>
                    <th scope="col">{{trans('admin.priceProduct')}}</th>
                    <th scope="col">{{trans('admin.brand')}}</th>
                    <th scope="col">{{trans('admin.category')}}</th>
                    <th scope="col">{{trans('admin.dateAdd')}}</th>
                    <th scope="col">{{trans('admin.dateEdit')}}</th>
                    <th scope="col" style="text-align:end">{{trans('admin.action')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productsData as $productData)
                <tr>
                    <th scope="row" style="color:#585858">{{$productData->id}}</td>
                    <td>{{$productData->name}}</td>
                    <td data-toggle="tooltip" data-placement="bottom" title="{{$productData->desc}}">{{Str::limit($productData->desc,30)}}</td>
                    <td><a href="{{$productData->image}}" target="_blank">{{Str::limit($productData->image,20)}}</a></td>
                    <td>{{number_format($productData->price,0,'.','.',)}}</td>
                    <td>{{$productData->productBrands->name}}</td>
                    <td>{{$productData->categories->name}}</td>
                    <td>{{$productData->created_at}}</td>
                    <td>{{$productData->updated_at}}</td>
                    <td>
                        <div class="row action-button">
                            <!-- edit button -->
                            <div class="action-edit">
                                <button type="submit" id="productModalEditBtn" data-id="{{$productData->id}}" class="btn btn-primary edit">
                                    <i class="fa fa-btn fa-edit"></i> {{trans('admin.edit')}}
                                </button>
                            </div>

                            <!-- delete button -->
                            <div class="action-delete">
                                <button type="button" id="productModalDelBtn" data-id="{{$productData->id}}" class="btn btn-danger">
                                    <i class="fa fa-btn fa-trash"></i> {{trans('admin.del')}}
                                </button>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{$productsData->links()}}
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
            $.get('{{route("brands.index")}}', function(data) {
                $list = '';
                data.forEach(element => {
                    $list += '<option value="' + element.id + '">' + element.name + '</option>';
                });
                $('#productSelectBrand').html($list);
            })
            $.get('{{route("categories.index")}}', function(data) {
                $list = '';
                data.forEach(element => {
                    $list += '<option value="' + element.id + '">' + element.name + '</option>';
                });
                $('#productSelectCate').html($list);
                console.log(data);
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
        var productEditInputPrice = $("#productEditInputPrice");
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
        productEditInputPrice.on('keyup', function() {
            productEditInputPrice.removeClass("is-invalid");
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
                $.get('{{route("brands.index")}}', function(data2) {
                    $list = '';
                    data2.forEach(element => {
                        $list += '<option value="' + element.id + '"' + ((element.id == data.product_brands_id) ? 'selected' : '') + '>' + element.name + '</option>';
                    });
                    $('#productEditSelectBrand').html($list);
                })
                $.get('{{route("categories.index")}}', function(data3) {
                    $list = '';
                    data3.forEach(element => {
                        $list += '<option value="' + element.id + '"' + ((element.id == data.categories_id) ? 'selected' : '') + '>' + element.name + '</option>';
                    });
                    $('#productEditSelectCate').html($list);
                })
            })
        });
        // edit action
        $("#productEditSubmit").click(function(e) {
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

            if ($('#productEditInputRating').val() < 0 || $('#productEditInputRating').val() > 5) {
                $('#productEditInputRating').addClass("is-invalid");
                $('#invalid-vote').html('Vote từ 0 đến 5');
                return false;
            }

            $.ajax({
                type: 'POST',
                url: 'products/' + id,
                data: $('#editModalProductForm').serialize(),
                success: function(data) {
                    if (data.status == 'success') {
                        $('#productEditModal').modal('hide');
                        location.reload();
                    }
                    if (data.isValidator) {
                        $('#editProductError').css('display', 'block');
                        $('#editProErrors').html("")
                        $.each(data.message, function(indexInArray, valueOfElement) {
                            $('#editProErrors').append("<li style='color:red'>" + valueOfElement + "</li>")
                        });
                    }
                },
                error: function(data, message, error) {
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
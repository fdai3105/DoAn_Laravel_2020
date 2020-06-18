@extends('admin.index')

<head>
    <title>Thương Hiệu | Admin Panel</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
</head>

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
            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#brandAddModal">
                <i class="fa fa-plus"></i> Thêm Hãng
            </button>
        </div>
    </div>

    <!-- display errors -->
    @include('common.errors')
    @include('admin.brand.partials.add_modal')
    @include('admin.brand.partials.edit_modal')
    @include('admin.brand.partials.del_modal')

    <!-- table -->
    <table class="table table-hover" id="brandTable">
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
                            <button type="button" id="brandModalEditBtn" data-id="{{$brandsData->id}}" class="btn btn-primary">
                                <i class=" fa fa-btn fa-edit"></i> Sửa
                            </button>
                        </div>

                        <!-- delete button -->
                        <div class="action-delete">
                            <button type="button" id="brandModalDelBtn" data-id="{{$brandsData->id}}" class="btn btn-danger">
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
@endsection

<script>
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //region dataTable
        $('#brandTable').DataTable({
            "paging": false,
            "info": false,
            'order': [
                [0, 'asc'],
            ],
            "columnDefs": [{
                "orderable": false,
                "targets": 4
            }]
        });
        // style dataTable
        // header
        $("#brandTable_filter").addClass("col-12");
        $('#brandTable_filter').find("input").addClass("form-control form-control-sm");
        //endregion

        //region add brand
        // show add modal by data-target on button tag
        var brandInputName = $("#brandInputName");
        // remove red alert on input box
        brandInputName.on('keyup', function() {
            brandInputName.removeClass("is-invalid");
        })
        $("#brandAddSubmit").click(function(e) {
            e.preventDefault();
            if ($("#brandInputName").val() == '') {
                brandInputName.addClass("is-invalid");
                return false;
            }
            $.ajax({
                type: 'POST',
                url: '{{route("brands.store")}}',
                data: $('#addBrandForm').serialize(),
                success: function(data) {
                    location.reload();
                    console.log('Add brand ajax: ' + JSON.stringify(data));
                },
                error: function(data) {
                    alert(JSON.stringify(data));
                }
            })
        })
        //endregion

        //region edit brand
        // show edit modal
        $("#brandEditModalInput").on('keyup', function() {
            $("#brandEditModalInput").removeClass("is-invalid");
        })
        $("button[id='brandModalEditBtn']").click(function() {
            var id = $(this).data("id");
            $.get("brands/" + id + "/edit", function(data) {
                $('#brandEditModal').modal('show');
                $('#brandEditModalTitle').html('Sửa ' + data.name + '?');
                $('#brandEditModalInput').val(data.name);
                $('#editBrandSubmit').data('id', id);
            })
        });
        // edit action
        $("button[id='editBrandSubmit']").click(function(e) {
            e.preventDefault();
            if ($("#brandEditModalInput").val() == '') {
                $("#brandEditModalInput").addClass("is-invalid");
                return false;
            }
            var id = $(this).data("id");
            $.ajax({
                type: 'POST',
                url: 'brands/' + id,
                data: $('#editModalBrandForm').serialize(),
                success: function(data) {
                    $('#brandEditModal').modal('hide');
                    location.reload();
                    console.log('Edit brand ajax: ' + JSON.stringify(data));
                },
                error: function(data) {
                    alert(JSON.stringify(data));
                }
            })
        })
        //endregion

        //region del brand
        // show del mođal
        $("button[id='brandModalDelBtn']").click(function() {
            var id = $(this).data("id");
            $.get("brands/" + id, function(data) {
                $('#brandDelModal').modal('show');
                $('#brandDelModalTitle').html('Xoá ' + data.name + '?');
                $('#brandDelSubmit').data('id', id);
                $.get("brands/findProducts/" + id, function(data2) {
                    $('#listProInBrand').html('');
                    if (Object.keys(data2).length > 1) {
                        var textnode = '';
                        $('#countPro').html('Lưu ý: ' + Object.keys(data2).length + ' sản phẩm trong danh mục này cũng sẽ bị xoá')
                        data2.forEach(element => {
                            textnode += '<dd>' + '- ' + element.name + '</dd>';
                        });
                        $('#listProInBrand').append(textnode);
                    } else {
                        $('#countPro').html('Bạn có muốn xoá "' + data.name + '" ?');
                    }
                })
            })
        });
        // del action
        $("button[id='brandDelSubmit']").click(function(e) {
            e.preventDefault();
            var id = $(this).data("id");
            $.ajax({
                type: 'DELETE',
                url: 'brands/' + id,
                success: function(data) {
                    $('#brandDelModal').modal('hide');
                    location.reload();
                    console.log('Delete category ajax: ' + JSON.stringify(data));
                },
                error: function(data) {
                    alert(JSON.stringify(data));
                }
            })
        });
        //endregion
    })
</script>
@extends('admin.index')

<head>
    <title>Danh Mục | Admin Panel</title>
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
                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#cateAddModal">
                    <i class="fa fa-plus" style="color:white !important"></i> Thêm Danh Mục
                </button>
            </li>
        </ol>
    </nav>

    <!-- display errors -->
    @include('common.errors')
    @include('admin.category.partials.add_modal')
    @include('admin.category.partials.del_modal')
    @include('admin.category.partials.edit_modal')

    <!-- table -->
    <div class="shadow" style="margin-left: 20px;margin-right: 20px; border-radius: 20px;background-color:white; padding: 20px;margin-bottom: 20px;">
        <h5>{{count($categoriesData)}} Categories</h5>

        <table class="table table-borderless table-hover" id="cateTable">
            <thead>
                <tr style="border-bottom: 1px solid #dbdbdb">
                    <th>ID</th>
                    <th>Tên Danh Mục</th>
                    <th>Ngày Thêm</th>
                    <th>Lần Sửa</th>
                    <th style="width: 10%;text-align:end">Hành động</th>
                </tr>
            </thead>
            <tbody id="cateTableBody">
                @foreach($categoriesData as $categoriesData)
                <tr id="cateItem{{$categoriesData->id}}">
                    <td>{{$categoriesData->id}}</td>
                    <td>{{$categoriesData->name}}</td>
                    <td>{{$categoriesData->created_at}}</td>
                    <td>{{$categoriesData->updated_at}}</td>
                    <td>
                        <div class="row action-button">
                            <!-- edit button -->
                            <div class="action-edit">
                                <button type="button" id="cateModalEditBtn" data-id="{{$categoriesData->id}}" class="btn btn-primary">
                                    <i class="fa fa-btn fa-edit"></i> Sửa
                                </button>
                            </div>

                            <!-- delete button -->
                            <div class="action-delete">
                                <button type="button" id="cateModalDelBtn" data-id="{{$categoriesData->id}}" class="btn btn-danger">
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
        $('#cateTable').DataTable({
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
        $('#cateTable_filter').addClass("col-12");
        $('#cateTable_filter').find("input").addClass("form-control form-control-sm");
        //endregion

        //region add
        // show add modal
        var cateInputName = $("#cateInputName");
        // remove red alert on input box
        cateInputName.on('keyup', function() {
            cateInputName.removeClass("is-invalid");
        })
        $("#cateAddSubmit").click(function(e) {
            e.preventDefault();
            if (cateInputName.val() == '') {
                cateInputName.addClass("is-invalid");
                return false;
            }
            $.ajax({
                type: 'POST',
                url: '{{route("categories.store")}}',
                data: $('#addCateForm').serialize(),
                success: function(data) {
                    location.reload();
                    console.log('Add category ajax: ' + JSON.stringify(data));
                },
                error: function(data) {
                    alert(JSON.stringify(data));
                }
            })
        })
        //endregion

        //region edit
        // show edit modal
        $('#cateInputEditName').on('keyup', function() {
            $('#cateInputEditName').removeClass("is-invalid");
        })
        $("button[id='cateModalEditBtn']").click(function() {
            var id = $(this).data("id");
            $.get("categories/" + id, function(data) {
                $('#cateEditModal').modal('show');
                $('#cateEditModalTitle').html('Sửa ' + data.name + '?');
                $('#cateInputEditName').val(data.name);
                $('#editCateSubmit').data('id', id);
            })
        });
        // edit action
        $("button[id='editCateSubmit']").click(function(e) {
            e.preventDefault();
            if ($('#cateInputEditName').val() == '') {
                $('#cateInputEditName').addClass("is-invalid");
                return false;
            }
            var id = $(this).data("id");
            $.ajax({
                type: 'POST',
                url: 'categories/' + id,
                data: $('#editCateForm').serialize(),
                success: function(data) {
                    $('#cateEditModal').modal('hide');
                    location.reload();
                    console.log('Edit category ajax: ' + JSON.stringify(data));
                },
                error: function(data) {
                    alert(JSON.stringify(data));
                }
            })
        })
        //endregion

        //region del
        // show del mođal
        $("button[id='cateModalDelBtn']").click(function() {
            var id = $(this).data("id");
            $.get("categories/" + id, function(data) {
                $('#cateDelModal').modal('show');
                $('#cateDelModalTitle').html('Xoá ' + data.name + '?');
                $('#cateDelSubmit').data('id', id);
                $.get("categories/" + id + "/products", function(data2) {
                    $('#listProInCate').html("");
                    if (Object.keys(data2).length > 1) {
                        var textnode = '';
                        $('#countPro').html('Lưu ý: ' + Object.keys(data2).length + ' sản phẩm trong danh mục này cũng sẽ bị xoá')
                        data2.forEach(element => {
                            textnode += '<dd>' + '- ' + element.name + '</dd>';
                        });
                        $('#listProInCate').append(textnode);
                    } else {
                        $('#countPro').html('Bạn có muốn xoá "' + data.name + '" ?');
                    }
                })
            })
        });
        // del action
        $("button[id='cateDelSubmit']").click(function(e) {
            e.preventDefault();
            var id = $(this).data("id");
            $.ajax({
                type: 'DELETE',
                url: 'categories/' + id,
                success: function(data) {
                    $('#cateDelModal').modal('hide');
                    location.reload();
                    console.log('Delete category ajax: ' + JSON.stringify(data));
                },
                error: function(data) {
                    alert(data);
                }
            })
        });
        //endregion

    })
</script>
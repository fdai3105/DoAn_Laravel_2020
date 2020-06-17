@extends('admin.index')

<head>
    <title>Danh Mục | Admin Panel</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
</head>

@section('content')
<div class="col-sm-10" id="content" style="background-color:white;margin-left: 16.69%; padding: 0;">
    <!-- header -->
    <div class="container-fluid">
        <div class="row header">
            <div class="col-2" style="display:flex">
                <img src="https://img.icons8.com/material/24/ffffff/sorting-answers--v1.png" />
                <h5 style="vertical-align:middle">Danh Mục</h5>
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
            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#addModal">
                <i class="fa fa-plus"></i> Thêm Danh Mục
            </button>
        </div>
    </div>

    <!-- display errors -->
    @include('common.errors')
    @include('admin.category.partials.add_modal')
    @include('admin.category.partials.del_modal')
    @include('admin.category.partials.edit_modal')

    <!-- table -->
    <table class="table table-hover" id="cateTable">
        <thead>
            <tr class="bg-primary">
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
                            <button type="button" id="modalCateEditBtn" data-id="{{$categoriesData->id}}" class="btn btn-primary">
                                <i class="fa fa-btn fa-edit"></i> Sửa
                            </button>
                        </div>

                        <!-- delete button -->
                        <div class="action-delete">
                            <button type="button" id="modalCateDelBtn" data-id="{{$categoriesData->id}}" class="btn btn-danger">
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

        //region add
        // show add modal
        var addCateBtn = $("#addCateBtn");
        var inputCateName = $("#inputCateName");
        // remove red alert on input box
        inputCateName.on('keyup', function() {
            inputCateName.removeClass("is-invalid");
        })
        addCateBtn.click(function(e) {
            e.preventDefault();
            var inputCateNameVal = $("#inputCateName").val();
            if (inputCateNameVal == '') {
                inputCateName.addClass("is-invalid");
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
        var modalCateEdit = $("button[id='modalCateEditBtn']");
        modalCateEdit.click(function() {
            var id = $(this).data("id");
            $.get("categories/" + id, function(data) {
                $('#editModal').modal('show');
                $('#edit-modal-title').html('Sửa ' + data.name + '?');
                $('#edit-modal-input').val(data.name);
                $('#editCateBtn').data('id', id);
            })
        });
        // edit action
        var editCateBtn = $("button[id='editCateBtn']");
        editCateBtn.click(function(e) {
            e.preventDefault();
            var id = $(this).data("id");
            $.ajax({
                type: 'POST',
                url: 'categories/' + id,
                data: $('#editCateForm').serialize(),
                success: function(data) {
                    $('#editModal').modal('hide');
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
        var modalCateDel = $("button[id='modalCateDelBtn']");
        modalCateDel.click(function() {
            var id = $(this).data("id");
            $.get("categories/" + id, function(data) {
                $('#delModal').modal('show');
                $('#modal-title').html('Xoá ' + data.name + '?');
                $('#delCateBtn').data('id', id);
                $.get("categories/" + id + "/edit", function(data2) {
                    $('#listProInCate').html("");
                    var textnode = '';
                    $('#countPro').html('Lưu ý: ' + Object.keys(data2).length + ' sản phẩm trong danh mục này cũng sẽ bị xoá')
                    data2.forEach(element => {
                        textnode += '<dd>' + '- ' + element.name + '</dd>';
                    });
                    $('#listProInCate').append(textnode);
                })
            })
        });
        // del action
        $("button[id='delCateBtn']").click(function(e) {
            e.preventDefault();
            var id = $(this).data("id");
            $.ajax({
                type: 'DELETE',
                url: 'categories/' + id,
                success: function(data) {
                    $('#delModal').modal('hide');
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
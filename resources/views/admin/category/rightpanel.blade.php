<div>
    <div class="row">
        <div class="col-lg-6">
            <h1>Danh Mục</h1>
        </div>

        <!-- add Modal -->
        <div class="col-lg-6 right">
            <div style="margin-top:20px">
                <button type="btn" class="btn btn-info btn-lg" data-toggle="modal" data-target="#addModal">
                    <i class="fa fa-plus"></i> Thêm Danh Mục
                </button>
            </div>

            <div class="modal fade" id="addModal" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Thêm danh mục</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- body modal -->
                        <div class="modal-body">
                            <form action="{{route('category.store')}}" method="POST" class="form-horizontal">
                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label for="task-name" class="col control-label">Tên Danh Mục</label>

                                    <div class="col">
                                        <input type="text" name="name" class="form-control">
                                    </div>
                                </div>

                                <!-- -->
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">
                                        <i></i>Thêm Danh Mục
                                    </button>
                                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Huỷ</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <br>
    @include('common.errors')

    <!-- table -->
    <table class="table table-hover">
        <thead>
            <tr class="bg-primary">
                <th>ID</th>
                <th>Tên Danh Mục</th>
                <th>Ngày Thêm</th>
                <th>Lần Sửa</th>
                <th style="width: 10%">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categoryData as $data)
            <tr>
                <td>{{$data->id}}</td>
                <td>{{$data->name}}</td>
                <td>{{$data->created_at}}</td>
                <td>{{$data->updated_at}}</td>
                <td>
                    <!-- delete button -->
                    <div>
                        <form action="{{ route('brand.destroy',$data->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button type="submit" class="btn btn-danger">
                                <i class="fa fa-btn fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>

                    <!-- edit button -->
                    <div>
                        <button type="submit" class="btn btn-primary edit" data-toggle="modal" data-target="#editModal{{$data->id}}">
                            <i class="fa fa-btn fa-edit"></i> Edit
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="editModal{{$data->id}}" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Sửa sản phẩm</h4>
                                        <button type="button" class="close" data-dismiss="editModal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('brand.update', $data->id)}}" method="POST" class="form-horizontal">
                                            @csrf
                                            @method('PUT')

                                            <div class="form-group">
                                                <label for="task-name" class="col control-label">Tên sản phẩm</label>
                                                <div class="col">
                                                    <input type="text" name="name" class="form-control" value="{{$data->name}}">
                                                </div>
                                            </div>

                                            <!--  -->
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success">
                                                    <i></i>Edit
                                                </button>
                                                <button type="button" class="btn btn-outline-danger" data-dismiss="editModal{{$data->id}}">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
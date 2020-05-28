<div>
    <div class="row">
        <div class="col-lg-6">
            <h1>Database: fdblog</h1>
        </div>

        <!-- add modal -->
        <div class="col-lg-6 right">
            <div style="margin-top:20px">
                <button type="btn" class="btn btn-info btn-lg" data-toggle="modal" data-target="#addModal">
                    <i class="fa fa-plus"></i> Thêm Product
                </button>
            </div>

            <!-- add Modal -->
            <div class="modal fade" id="addModal" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Thêm sản phẩm</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- modal body -->
                        <div class="modal-body">
                            <form action="{{route('product.store')}}" method="POST" class="form-horizontal">
                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label class="col control-label">Tên sản phẩm</label>

                                    <div class="col">
                                        <input type="text" name="name" id="task-name" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col control-label">Mô tả</label>

                                    <div class="col">
                                        <input type="text" name="desc" id="task-name" class="form-control">
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="col control-label">Ảnh</label>

                                    <div class="col">
                                        <input type="text" name="image" id="task-name" class="form-control">
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="col control-label">Giá</label>

                                    <div class="col">
                                        <input type="text" name="price" id="task-name" class="form-control">
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="col control-label">Thương hiệu</label>

                                    <div class="col">
                                        <select class="form-control" name="product_brands_id">
                                            @foreach($data['product_brands'] as $dataBrand)
                                            <option value="{{$dataBrand->id}}">{{$dataBrand->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class=" form-group">
                                    <label class="col control-label">Danh mục</label>

                                    <div class="col">
                                        <select class="form-control" name="categories_id">
                                            @foreach($data['product_category'] as $dataCategory)
                                            <option value="{{$dataCategory->id}}">{{$dataCategory->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">
                                        <i></i>Thêm Hàng
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
                <th style="width: 5% !important">ID</th>
                <th style="width: 20% !important">Tên sản phẩm</th>
                <th style="width: 30% !important">Mô tả</th>
                <th style="width: 5% !important">Ảnh</th>
                <th style="width: 10% !important">Giá</th>
                <th style="width: 10% !important">Thương Hiệu</th>
                <th style="width: 10% !important">Danh Mục</th>
                <th style="width: 20% !important">Ngày thêm</th>
                <th style="width: 20% !important">Ngày sửa</th>
                <th style="width: 20% !important">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['products'] as $data)
            <tr>
                <td>{{$data->id}}</td>
                <td>{{$data->name}}</td>
                <td>{{$data->desc}}</td>
                <td>{{$data->image}}</td>
                <td>{{$data->price}}</td>
                <td>{{$data->productBrand->name}}</td>
                <td>{{$data->category->name}}</td>
                <td>{{$data->created_at}}</td>
                <td>{{$data->updated_at}}</td>
                <td>
                    <div>
                        <form action="{{ route('product.destroy',$data->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button type="submit" class="btn btn-danger">
                                <i class="fa fa-btn fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary edit" data-toggle="modal" data-target="#editModal">
                            <i class="fa fa-btn fa-edit"></i> Edit
                        </button>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Sửa sản phẩm</h4>
                                        <button type="button" class="close" data-dismiss="editModal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('product.update', $data->id)}}" method="POST" class="form-horizontal">
                                            @csrf
                                            @method('PUT')

                                            <div class="form-group">
                                                <label for="task-name" class="col control-label">Tên sản phẩm</label>

                                                <div class="col">
                                                    <input type="text" name="name" class="form-control" value="{{$data->name}}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="task-name" class="col control-label">Mô tả</label>
                                                <div class="col">
                                                    <input type="text" name="desc" class="form-control" value="{{$data->desc}}">
                                                </div>

                                            </div>
                                            <div class="form-group">
                                                <label for="task-name" class="col control-label">Ảnh</label>
                                                <div class="col">
                                                    <input type="text" name="image" class="form-control" value="{{$data->image}}">
                                                </div>

                                            </div>
                                            <div class="form-group">
                                                <label for="task-name" class="col control-label">Giá</label>

                                                <div class="col">
                                                    <input type="text" name="price" class="form-control" value="{{$data->price}}">
                                                </div>

                                            </div>
                                            <div class="form-group">
                                                <label for="task-name" class="col control-label">Thương hiệu</label>
                                                <div class="col">
                                                    <select class="form-control" name="product_brands_id">
                                                        @foreach($brandsData as $brands)
                                                        <option value="{{$brands->id}}" {{$data->product_brands_id == $brands->id ? 'selected' : ''}}>{{$brands->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>
                                            <div class=" form-group">
                                                <label for="task-name" class="col control-label">Danh mục</label>

                                                <div class="col">
                                                    <select class="form-control" name="categories_id">
                                                        @foreach($categoriesData as $categories)
                                                        <option value="{{$categories->id}}" {{$data->category->id == $categories->id ? 'selected' : ''}}>{{$categories->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <!--  -->
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success">
                                                    <i></i>Sửa
                                                </button>
                                                <button type="button" class="btn btn-outline-danger" data-dismiss="editModal">Huỷ</button>
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
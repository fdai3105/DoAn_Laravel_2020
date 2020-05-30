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
                <form action="{{route('products.store')}}" method="POST" class="form-horizontal">
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
                                @foreach($brandsData as $brandsData)
                                <option value="{{$brandsData->id}}">{{$brandsData->name}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class=" form-group">
                        <label class="col control-label">Danh mục</label>

                        <div class="col">
                            <select class="form-control" name="categories_id">
                                @foreach($categoriesData as $categoriesData)
                                <option value="{{$categoriesData->id}}">{{$categoriesData->name}}</option>
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
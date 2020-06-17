<!-- add Modal -->
<div class="modal fade" id="productAddModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Thêm sản phẩm</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- modal body -->
            <div class="modal-body">
                <form class="form-horizontal" id="addProductForm">
                    <div class="form-group">
                        <label class="col control-label">Tên sản phẩm</label>

                        <div class="col">
                            <input type="text" name="name" id="productInputName" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col control-label">Mô tả</label>
                        <div class="col">
                            <input type="text" name="desc" id="productInputDesc" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col control-label">Ảnh</label>
                        <div class="col">
                            <input type="text" name="image" id="productInputImage" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col control-label">Đánh giá</label>
                        <div class="col">
                            <input type="text" name="vote" id="productInputRating" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col control-label">Giá</label>
                        <div class="col">
                            <input type="text" name="price" id="productInputPrice" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col control-label">Thương hiệu</label>
                        <div class="col">
                            <select class="form-control" id="productSelectBrand" name="product_brands_id">
                            </select>
                        </div>
                    </div>
                    <div class=" form-group">
                        <label class="col control-label">Danh mục</label>
                        <div class="col">
                            <select class="form-control" id="productSelectCate" name="categories_id">
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="brandAddSubmit" class="btn btn-success">
                            <i></i>Thêm Hàng
                        </button>
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Huỷ</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
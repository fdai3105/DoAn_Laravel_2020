<div class="modal fade" id="cateAddModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title" style="color:white !important">Thêm danh mục</h5>
                <button type="button" style="color:white !important" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- body modal -->
            <div class="modal-body">
                <form class="form-horizontal" id="addCateForm">
                    <div class="form-group">
                        <label for="task-name" class="col control-label">Tên Danh Mục</label>
                        <div class="col">
                            <input type="text" name="name" id="cateInputName" class="form-control">
                            <div class="invalid-feedback">
                                Please choose a username.
                            </div>
                        </div>
                    </div>

                    <!--footer-->
                    <div class="modal-footer">
                        <button type="submit" id="cateAddSubmit" class="btn btn-info">
                            <i></i>Thêm Danh Mục
                        </button>
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Huỷ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
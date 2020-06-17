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
                <form class="form-horizontal" id="addCateForm">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="task-name" class="col control-label">Tên Danh Mục</label>
                        <div class="col">
                            <input type="text" name="name" id="inputCateName" class="form-control">
                            <div class="invalid-feedback" id="inputCateError">
                                Please choose a username.
                            </div>
                        </div>
                    </div>

                    <!--footer-->
                    <div class="modal-footer">
                        <button type="submit" id="addCateBtn" class="btn btn-success">
                            <i></i>Thêm Danh Mục
                        </button>
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Huỷ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
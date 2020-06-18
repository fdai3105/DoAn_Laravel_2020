<!-- Edit Modal -->
<div class="modal fade" id="cateEditModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title" id="cateEditModalTitle" style="color:white !important"></h4>
                <button type="button" class="close" style="color:white !important" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="editCateForm" class="form-horizontal">
                    @method('PUT')
                    <div class="form-group">
                        <label for="task-name" class="col control-label">Tên danh mục:</label>
                        <div class="col">
                            <input type="text" name="name" id="cateInputEditName" class="form-control">
                            <div class="invalid-feedback">
                                Please choose a username.
                            </div>
                        </div>
                    </div>

                    <!--  -->
                    <div class="modal-footer">
                        <button type="submit" id="editCateSubmit" class="btn btn-primary">
                            <i></i>Edit
                        </button>
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
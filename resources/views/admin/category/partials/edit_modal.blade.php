<!-- Edit Modal -->
<div class="modal fade" id="editModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="edit-modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="editCateForm" class="form-horizontal">
                    @method('PUT')
                    <div class="form-group">
                        <label for="task-name" class="col control-label">Tên danh mục:</label>
                        <div class="col">
                            <input type="text" name="name" id="edit-modal-input" class="form-control">
                        </div>
                    </div>

                    <!--  -->
                    <div class="modal-footer">
                        <button type="submit" id="editCateBtn" class="btn btn-success">
                            <i></i>Edit
                        </button>
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
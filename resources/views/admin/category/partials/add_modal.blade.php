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
                <form action="{{route('categories.store')}}" method="POST" class="form-horizontal">
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
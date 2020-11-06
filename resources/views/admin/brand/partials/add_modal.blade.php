<!-- add modal -->
<div class="modal fade" id="brandAddModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title" style="color:white !important">{{trans('admin.addBrand')}}</h5>
                <button type="button" class="close" data-dismiss="modal" style="color:white !important">&times;</button>
            </div>

            <!-- body modal -->
            <div class="modal-body">
                <form class="form-horizontal" id="addBrandForm">
                    <div class="form-group">
                        <label for="task-name" class="col control-label">{{trans('admin.nameBrand')}}</label>
                        <div class="col">
                            <input type="text" name="name" id="brandInputName" class="form-control">
                            <div class="invalid-feedback" id="brandInputError">
                                {{trans('admin.usernameEmpty')}}
                            </div>
                        </div>
                    </div>

                    <!--footer-->
                    <div class="modal-footer">
                        <button type="submit" id="brandAddSubmit" class="btn btn-info">
                            <i></i>{{trans('admin.nameBrand')}}
                        </button>
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">{{trans('admin.cancel')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
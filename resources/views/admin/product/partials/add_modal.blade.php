<!-- add Modal -->
<div class="modal fade" id="productAddModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{trans('admin.addProduct')}}</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- modal body -->
            <div class="modal-body">
                <form class="form-horizontal" id="addProductForm">
                    <div class="form-group">
                        <label class="col control-label">{{trans('admin.nameProduct')}}</label>
                        <div class="col">
                            <input type="text" name="name" id="productInputName" class="form-control">
                            <div class="invalid-tooltip">
                                Please choose a unique and valid username.
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col control-label">{{trans('admin.descProduct')}}</label>
                        <div class="col">
                            <input type="text" name="desc" id="productInputDesc" class="form-control">
                            <div class="invalid-tooltip">
                                Please choose a unique and valid username.
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col control-label">{{trans('admin.imgProduct')}}</label>
                        <div class="col">
                            <input type="text" name="image" id="productInputImage" class="form-control">
                            <div class="invalid-tooltip">
                                Please choose a unique and valid username.
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col" style="padding-right:0px">
                            <div class="form-group">
                                <label class="col control-label">{{trans('admin.priceProduct')}}</label>
                                <div class="col">
                                    <input type="text" name="price" id="productInputPrice" class="form-control">
                                    <div class="invalid-tooltip">
                                        Please choose a unique and valid username.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-4" style="padding-left: 0px">
                            <div class="form-group">
                                <label class="col control-label">{{trans('admin.voteProduct')}}</label>
                                <div class="col">
                                    <input type="text" name="vote" id="productInputRating" class="form-control">
                                    <div class="invalid-tooltip">
                                        Please choose a unique and valid username.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col control-label">{{trans('admin.brand')}}</label>
                        <div class="col">
                            <select class="form-control" id="productSelectBrand" name="product_brands_id">
                            </select>
                        </div>
                    </div>
                    <div class=" form-group">
                        <label class="col control-label">{{trans('admin.category')}}</label>
                        <div class="col">
                            <select class="form-control" id="productSelectCate" name="categories_id">
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="brandAddSubmit" class="btn btn-success">
                            <i></i>{{trans('admin.addProduct')}}
                        </button>
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">{{trans('admin.cancel')}}</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
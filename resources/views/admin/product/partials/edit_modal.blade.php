 <!-- Edit Modal -->
 <div class="modal fade" id="productEditModal" role="dialog">
     <div class="modal-dialog">

         <!-- Modal content-->
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="modal-title" id="editModalTitle">{{trans('admin.editProduct')}}</h4>
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
             </div>
             <div class="modal-body">
                 <form class="form-horizontal" id="editModalProductForm">
                     @csrf
                     @method('PUT')
                     <div class="form-group" style="display: none;" id="editProductError">
                         <div class="col" id="editProErrors">
                         </div>
                     </div>
                     <div class="form-group">
                         <label for="task-name" class="col control-label">{{trans('admin.nameProduct')}}</label>

                         <div class="col">
                             <input type="text" id="productEditInputName" name="name" class="form-control">
                             <div class="invalid-tooltip">
                                 Please choose a unique and valid username.
                             </div>
                         </div>
                     </div>
                     <div class="form-group">
                         <label for="task-name" class="col control-label">{{trans('admin.descProduct')}}</label>
                         <div class="col">
                             <input type="text" name="desc" id="productEditInputDesc" class="form-control">
                             <div class="invalid-tooltip">
                                 Please choose a unique and valid username.
                             </div>
                         </div>

                     </div>
                     <div class="form-group">
                         <label for="task-name" class="col control-label">{{trans('admin.imgProduct')}}</label>
                         <div class="col">
                             <input type="text" name="image" id="productEditInputImage" class="form-control">
                             <div class="invalid-tooltip">
                                 Please choose a unique and valid username.
                             </div>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col" style="padding-right:0px">
                             <div class="form-group">
                                 <label for="task-name" class="col control-label">{{trans('admin.priceProduct')}}</label>
                                 <div class="col">
                                     <input type="text" id="productEditInputPrice" min="1000" max="any" step="1000" name="price" class="form-control">
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
                                     <input type="number" name="vote" id="productEditInputRating" max="5" min="0" class="form-control">
                                     <div class="invalid-tooltip">
                                         Please choose a unique and valid username.
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="form-group">
                         <label for="task-name" class="col control-label">{{trans('admin.brand')}}</label>
                         <div class="col">
                             <select class="form-control" id="productEditSelectBrand" name="product_brands_id">
                                 <option value=""></option>
                             </select>
                         </div>

                     </div>
                     <div class=" form-group">
                         <label for="task-name" class="col control-label">{{trans('admin.category')}}</label>

                         <div class="col">
                             <select class="form-control" id="productEditSelectCate" name="categories_id">
                                 <option value=""></option>
                             </select>
                         </div>
                     </div>

                     <!--  -->
                     <div class="modal-footer">
                         <div class='row'>
                             <button type="submit" id="productEditSubmit" class="btn btn-success">
                                 <i></i>{{trans('admin.edit')}}
                             </button>
                             <button type="button" class="btn btn-outline-danger" data-dismiss="modal">{{trans('admin.cancel')}}</button>
                         </div>
                     </div>
                 </form>
             </div>
         </div>

     </div>
 </div>
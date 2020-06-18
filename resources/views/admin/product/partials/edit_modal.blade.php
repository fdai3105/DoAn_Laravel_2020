 <!-- Edit Modal -->
 <div class="modal fade" id="productEditModal" role="dialog">
     <div class="modal-dialog">

         <!-- Modal content-->
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="modal-title" id="editModalTitle">Sửa sản phẩm</h4>
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
             </div>
             <div class="modal-body">
                 <form class="form-horizontal">
                     @csrf
                     @method('PUT')

                     <div class="form-group">
                         <label for="task-name" class="col control-label">Tên sản phẩm</label>

                         <div class="col">
                             <input type="text" id="productEditInputName" name="name" class="form-control">
                         </div>
                     </div>
                     <div class="form-group">
                         <label for="task-name" class="col control-label">Mô tả</label>
                         <div class="col">
                             <input type="text" name="desc" id="productEditInputDesc" class="form-control">
                         </div>

                     </div>
                     <div class="form-group">
                         <label for="task-name" class="col control-label">Ảnh</label>
                         <div class="col">
                             <input type="text" name="image" id="productEditInputImage" class="form-control">
                         </div>
                     </div>

                     <div class="form-group">
                         <label class="col control-label">Đánh giá</label>
                         <div class="col">
                             <input type="text" name="vote" id="productEditInputRating" class="form-control">
                         </div>
                     </div>

                     <div class="form-group">
                         <label for="task-name" class="col control-label">Giá</label>
                         <div class="col">
                             <input type="text" name="price" id="productEditInputPrice" class="form-control">
                         </div>
                     </div>
                     <div class="form-group">
                         <label for="task-name" class="col control-label">Thương hiệu</label>
                         <div class="col">
                             <select class="form-control" id="productSelectBrand" name="product_brands_id">
                                 <option value=""></option>
                             </select>
                         </div>

                     </div>
                     <div class=" form-group">
                         <label for="task-name" class="col control-label">Danh mục</label>

                         <div class="col">
                             <select class="form-control" id="productSelectCate" name="categories_id">
                                 <option value=""></option>
                             </select>
                         </div>
                     </div>

                     <!--  -->
                     <div class="modal-footer">
                         <div class='row'>
                             <button type="submit" id="productEditSubmit" class="btn btn-success">
                                 <i></i>Sửa
                             </button>
                             <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Huỷ</button>
                         </div>
                     </div>
                 </form>
             </div>
         </div>

     </div>
 </div>
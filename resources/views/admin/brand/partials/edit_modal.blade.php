 <!-- edit modal -->
 <div class="modal fade" id="brandEditModal" role="dialog">
     <div class="modal-dialog">
         <!-- Modal content-->
         <div class="modal-content">
             <div class="modal-header bg-primary">
                 <h4 class="modal-title" id="brandEditModalTitle" style="color:white !important"></h4>
                 <button type="button" class="close" data-dismiss="modal" style="color:white !important">&times;</button>
             </div>
             <div class="modal-body">
                 <form id="editModalBrandForm" class="form-horizontal">
                     @method('PUT')
                     <div class="form-group">
                         <label for="task-name" class="col control-label">Tên hãng:</label>
                         <div class="col">
                             <input type="text" id="brandEditModalInput" name="name" class="form-control">
                             <div class="invalid-feedback">
                                 Please choose a username.
                             </div>
                         </div>
                     </div>

                     <!--  -->
                     <div class="modal-footer">
                         <button type="submit" id="editBrandSubmit" class="btn btn-primary">
                             <i></i>Edit
                         </button>
                         <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                     </div>
                 </form>
             </div>
         </div>

     </div>
 </div>
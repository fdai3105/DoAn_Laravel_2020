 <!-- edit modal -->
 <div class="modal fade" id="productDelModal" role="dialog">
     <div class="modal-dialog">
         <!-- Modal content-->
         <div class="modal-content">
             <div class="modal-header bg-danger">
                 <h4 class="modal-title" id="productDelModalTitle" style="color:white !important"></h4>
                 <button type="button" class="close" data-dismiss="modal" style="color:white !important">&times;</button>
             </div>
             <div class="modal-body">
                 <form class="action-form">
                     <p style="font-weight: 500;" id="countPro"></p>
                     <!-- footer-->
                     <div class="modal-footer">
                         <!-- set data-id by ajax in admin/brand/index line 131 -->
                         <button type="submit" id="productDelSubmit" class="btn btn-danger">
                             <i class="fa fa-btn fa-trash"></i> Xoá
                         </button>
                         <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Đóng</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>
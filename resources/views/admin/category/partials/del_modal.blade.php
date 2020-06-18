 <!-- edit modal -->
 <div class="modal fade" id="cateDelModal" role="dialog">
     <div class="modal-dialog">
         <!-- Modal content-->
         <div class="modal-content">
             <div class="modal-header bg-danger">
                 <h4 class="modal-title" id="cateDelModalTitle" style="color:white !important"></h4>
                 <button type="button" class="close" style="color:white" data-dismiss="modal">&times;</button>
             </div>
             <div class="modal-body">
                 <form class="action-form">
                     <p style="font-weight: 500;margin-bottom: 0;" id="countPro"></p>
                     <dl id="listProInCate">
                         <dd style="color: black"></dd>
                     </dl>
                     <!-- footer-->
                     <div class="modal-footer">
                         <!-- set data-id by ajax in admin/cate/index line 131 -->
                         <button type="submit" id="cateDelSubmit" class="btn btn-danger">
                             <i class="fa fa-btn fa-trash"></i> Delete
                         </button>
                         <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>
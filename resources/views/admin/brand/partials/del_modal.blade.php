 <!-- edit modal -->
 <div class="modal fade" id="brandDelModal" role="dialog">
     <div class="modal-dialog">
         <!-- Modal content-->
         <div class="modal-content">
             <div class="modal-header bg-danger">
                 <h4 class="modal-title" id="brandDelModalTitle" style="color:white !important"></h4>
                 <button type="button" class="close" data-dismiss="modal" style="color:white !important">&times;</button>
             </div>
             <div class="modal-body">
                 <form class="action-form">
                     <p style="font-weight: 500;margin-bottom:0" id="countPro"></p>
                     <dl id="listProInBrand">
                     </dl>
                     <!-- footer-->
                     <div class="modal-footer">
                         <!-- set data-id by ajax in admin/brand/index line 131 -->
                         <button type="submit" id="brandDelSubmit" class="btn btn-danger">
                             <i class="fa fa-btn fa-trash"></i>
                             {{trans('admin.del')}}
                         </button>
                         <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">{{trans('admin.cancel')}}</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>
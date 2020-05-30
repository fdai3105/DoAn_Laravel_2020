 <!-- edit modal -->
 <div class="modal fade" id="delModal{{$categoriesData->id}}" role="dialog">
     <div class="modal-dialog">
         <!-- Modal content-->
         <div class="modal-content">
             <div class="modal-header bg-danger">
                 <h4 class="modal-title" style="color:white !important">Xoá danh mục</h4>
                 <button type="button" class="close" style="color:white" data-dismiss="modal">&times;</button>
             </div>
             <div class="modal-body">
                 <form action="{{ route('categories.destroy',$categoriesData->id) }}" class="action-form" method="POST">
                     {{ csrf_field() }}
                     {{ method_field('DELETE') }}

                     <p style="color: black">Bạn có chắc chắn muốn xoá {{$categoriesData->name}}?</p>
                     <dl>
                         <dt style="color: black">Lưu ý: {{count($categoriesData->product)}} sản phẩm trong danh mục này cũng sẽ bị xoá</dt>
                         @foreach($categoriesData->product->pluck('name') as $listProduct)
                         <dd style="color: black">- {{$listProduct}}</dd>
                         @endforeach
                     </dl>
                     <!-- footer-->
                     <div class="modal-footer">
                         <button type="submit" class="btn btn-danger">
                             <i class="fa fa-btn fa-trash"></i> Delete
                         </button>
                         <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                     </div>
                 </form>
             </div>
         </div>

     </div>
 </div>
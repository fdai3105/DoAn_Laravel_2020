 <!-- Edit Modal -->
 <div class="modal fade" id="editModal{{$productsData->id}}" role="dialog">
     <div class="modal-dialog">

         <!-- Modal content-->
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="modal-title">Sửa sản phẩm</h4>
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
             </div>
             <div class="modal-body">
                 <form action="{{route('products.update', $productsData->id)}}" method="POST" class="form-horizontal">
                     @csrf
                     @method('PUT')

                     <div class="form-group">
                         <label for="task-name" class="col control-label">Tên sản phẩm</label>

                         <div class="col">
                             <input type="text" name="name" class="form-control" value="{{$productsData->name}}">
                         </div>
                     </div>
                     <div class="form-group">
                         <label for="task-name" class="col control-label">Mô tả</label>
                         <div class="col">
                             <input type="text" name="desc" class="form-control" value="{{$productsData->desc}}">
                         </div>

                     </div>
                     <div class="form-group">
                         <label for="task-name" class="col control-label">Ảnh</label>
                         <div class="col">
                             <input type="text" name="image" class="form-control" value="{{$productsData->image}}">
                         </div>

                     </div>
                     <div class="form-group">
                         <label for="task-name" class="col control-label">Giá</label>

                         <div class="col">
                             <input type="text" name="price" class="form-control" value="{{$productsData->price}}">
                         </div>

                     </div>
                     <div class="form-group">
                         <label for="task-name" class="col control-label">Thương hiệu</label>
                         <div class="col">
                             <select class="form-control" name="product_brands_id">
                                 @foreach($brandsData as $brandsData)
                                 <option value="{{$brandsData->id}}" {{$productsData->product_brands_id == $brandsData->id ? 'selected' : ''}}>{{$brandsData->name}}</option>
                                 @endforeach
                             </select>
                         </div>

                     </div>
                     <div class=" form-group">
                         <label for="task-name" class="col control-label">Danh mục</label>

                         <div class="col">
                             <select class="form-control" name="categories_id">
                                 @foreach($categoriesData as $categories)
                                 <option value="{{$categories->id}}" {{$productsData->categories_id == $categories->id ? 'selected' : ''}}>{{$categories->name}}</option>
                                 @endforeach
                             </select>
                         </div>
                     </div>

                     <!--  -->
                     <div class="modal-footer">
                         <div class='row'>
                             <button type="submit" class="btn btn-success">
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
 <div>
     <div class="row">
         <div class="col-lg-6">
             <h1>Database: fdblog</h1>
         </div>

         <div class="col-lg-6 right">
             <div style="margin-top:20px">
                 <button type="btn" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">
                     <i class="fa fa-plus"></i>+ Thêm Product
                 </button>
             </div>

             <!-- Modal -->
             <div class="modal fade" id="myModal" role="dialog">
                 <div class="modal-dialog">

                     <!-- Modal content-->
                     <div class="modal-content">
                         <div class="modal-header">
                             <button type="button" class="close" data-dismiss="modal">&times;</button>
                             <h4 class="modal-title">Thêm sản phẩm</h4>
                         </div>
                         <div class="modal-body">
                             <form action="{{route('products.store')}}" method="POST" class="form-horizontal">
                                 {{ csrf_field() }}

                                 <div class="form-group">
                                     <label for="task-name" class="col-sm-4 control-label">Tên sản phẩm</label>

                                     <div class="col-sm-6">
                                         <input type="text" name="name" id="task-name" class="form-control" value="{{ old('task') }}">
                                     </div>
                                 </div>
                                 <div class="form-group">
                                     <label for="task-name" class="col-sm-4 control-label">Mô tả</label>

                                     <div class="col-sm-6">
                                         <input type="text" name="desc" id="task-name" class="form-control" value="{{ old('task') }}">
                                     </div>

                                 </div>
                                 <div class="form-group">
                                     <label for="task-name" class="col-sm-4 control-label">Ảnh</label>

                                     <div class="col-sm-6">
                                         <input type="text" name="image" id="task-name" class="form-control" value="{{ old('task') }}">
                                     </div>

                                 </div>
                                 <div class="form-group">
                                     <label for="task-name" class="col-sm-4 control-label">Giá</label>

                                     <div class="col-sm-6">
                                         <input type="text" name="price" id="task-name" class="form-control" value="{{ old('task') }}">
                                     </div>

                                 </div>
                                 <div class="form-group">
                                     <label for="task-name" class="col-sm-4 control-label">Thương hiệu</label>

                                     <div class="col-sm-6">
                                         <select class="form-control" name="product_brands_id" id="sel-brand">
                                             @foreach($data['product_brands'] as $dataBrand)
                                             <option value="{{$dataBrand->id}}">{{$dataBrand->name}}</option>
                                             @endforeach
                                         </select>
                                     </div>

                                 </div>
                                 <div class=" form-group">
                                     <label for="task-name" class="col-sm-4 control-label">Danh mục</label>

                                     <div class="col-sm-6">
                                         <select class="form-control" name="categories_id" id="sel-category">
                                             @foreach($data['product_category'] as $dataCategory)
                                             <option value="{{$dataCategory->id}}">{{$dataCategory->name}}</option>
                                             @endforeach
                                         </select>
                                     </div>
                                 </div>
                                 <div class="modal-footer">
                                     <button type="submit" class="btn btn-default">
                                         <i></i>Add Task
                                     </button>
                                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                 </div>
                             </form>
                         </div>
                     </div>

                 </div>
             </div>
         </div>

     </div>

     <br>
     @include('common.errors')

     <table class="table table-hover">
         <thead>
             <tr class="bg-primary">
                 <th style="width: 5% !important">ID</th>
                 <th style="width: 20% !important">Tên sản phẩm</th>
                 <th style="width: 30% !important">Mô tả</th>
                 <th style="width: 5% !important">Ảnh</th>
                 <th style="width: 10% !important">Giá</th>
                 <th style="width: 10% !important">Thương Hiệu</th>
                 <th style="width: 10% !important">Danh Mục</th>
                 <th style="width: 20% !important">Ngày thêm</th>
                 <th style="width: 20% !important">Ngày sửa</th>
                 <th style="width: 20% !important">Hành động</th>
             </tr>
         </thead>
         <tbody>
             @foreach($data['products'] as $data)
             <tr>
                 <td>{{$data->id}}</td>
                 <td>{{$data->name}}</td>
                 <td>{{$data->desc}}</td>
                 <td>{{$data->image}}</td>
                 <td>{{$data->price}}</td>
                 <td>{{$data->productsBrand->name}}</td>
                 <td>{{$data->categories->name}}</td>
                 <td>{{$data->created_at}}</td>
                 <td>{{$data->updated_at}}</td>
                 <td>
                     <form action="{{ route('products.destroy',$data->id) }}" method="POST">
                         {{ csrf_field() }}
                         {{ method_field('DELETE') }}

                         <button type="submit" class="btn btn-danger">
                             <i class="fa fa-btn fa-trash"></i> Delete
                         </button>
                     </form>
                 </td>
             </tr>
             @endforeach
         </tbody>
     </table>
 </div>
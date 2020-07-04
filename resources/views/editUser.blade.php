 <!-- Modal sửa thông tin -->
 <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModal" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Chỉnh sửa</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <div class="form-group" style="display: block;" id="loginError">
                     <div class="col" style="color:red" id="loginErrors">
                     </div>
                 </div>
                 <form id="editForm" class="form-horizontal">
                     @csrf
                     @method('PUT')

                     <div class="form-group">
                         <div class="col">
                             <input type="text" id="editInputFullName" name="fullname" placeholder="Tên đầy đủ" class="form-control" autocomplete="off">
                             <div class="invalid-tooltip">
                                 Tên không được để trống.
                             </div>
                         </div>
                     </div>
                     <div class="form-group">
                         <div class="col">
                             <input type="text" id="editInputEmail" disabled placeholder="Email khách hàng" class="form-control" autocomplete="off">
                         </div>
                     </div>
                     <div class="form-group">
                         <div class="col">
                             <input type="text" id="editInputPhone" name="phone" placeholder="Số điện thoại" class="form-control" autocomplete="off">
                             <div class="invalid-tooltip">
                                 Số điện thoại không được để trống.
                             </div>
                         </div>
                     </div>
                     <div class="form-group">
                         <div class="col">
                             <label>Giới tính</label>
                             <div style="display: flex;justify-content: space-evenly;">
                                 <div class="form-check form-check-inline">
                                     <input class="form-check-input" type="radio" name="gender" id="radioMale" value="Male">
                                     <label class="form-check-label" for="inlineRadio1">Nam</label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                     <input class="form-check-input" type="radio" name="gender" id="radioFemale" value="Female">
                                     <label class="form-check-label" for="inlineRadio2">Nữ</label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                     <input class="form-check-input" type="radio" name="gender" id="radioOther" value="Other">
                                     <label class="form-check-label" for="inlineRadio2">Khác</label>
                                 </div>
                             </div>
                         </div>
                     </div>

                     <hr>

                     <div class="form-group">
                         <div class="col">
                             <label>Thành phố</label>
                             <select class="form-control" name="city" id="editUserCity">
                                 <option>Chọn thành phố...</option>
                             </select>
                         </div>
                     </div>
                     <div class="form-group">
                         <div class="col">
                             <label>Tỉnh</label>
                             <select class="form-control" name="district" id="editUserDistrict" disabled>
                                 <option>Chọn tỉnh...</option>
                             </select>
                         </div>
                     </div>
                     <div class="form-group">
                         <div class="col">
                             <label>Phường</label>
                             <select class="form-control" name="ward" id="editUserWard" disabled>
                                 <option>Chọn phường...</option>
                             </select>
                         </div>
                     </div>
                     <div class="modal-footer">
                         <button type="submit" id="editSubmit" class="btn btn-primary">Đăng nhập</button>
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Huỷ</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>

 <script>
     /**
      * set data to edit user Modal
      * */
     function setData() {
         $("#editUserModal").modal('show');
         idUser = "{{Auth::user()->id}}"
         $("#editUserModal").modal('show');
         $.get("{{url('user')}}/" + idUser, function(data, textStatus) {
             $("#editInputFullName").val(data.fullname);
             $("#editInputEmail").val(data.email);
             $("#editInputPhone").val(data.phone);
             switch (data.gender) {
                 case 'Male':
                     $("#radioMale").prop("checked", true);
                     break;
                 case 'Female':
                     $("#radioFemale").prop("checked", true);
                     break;
                 case 'Other':
                     $("#radioOther").prop("checked", true);
                     break;
                 default:
                     break;
             }
             $.get("{{url('address')}}/" + data.address_id, function(data2, textStatus) {
                 $("#editUserCity").val(data2.city).change()
                 $('#editUserDistrict').removeAttr('disabled')
                 $("#editUserDistrict").val(data2.district)
                 $('#editUserWard').removeAttr('disabled')
             });
         });
     }
     $("#showEditModal").click(function(e) {
         e.preventDefault();
         idUser = "{{Auth::user()->id}}"
         $("#editUserModal").modal('show');
         $.get("{{url('user')}}/" + idUser, function(data, textStatus) {
             $("#editInputFullName").val(data.fullname);
             $("#editInputEmail").val(data.email);
             $("#editInputPhone").val(data.phone);
             switch (data.gender) {
                 case 'Male':
                     $("#radioMale").prop("checked", true);
                     break;
                 case 'Female':
                     $("#radioFemale").prop("checked", true);
                     break;
                 case 'Other':
                     $("#radioOther").prop("checked", true);
                     break;
                 default:
                     break;
             }
             $.get("{{url('address')}}/" + data.address_id, function(data2, textStatus) {
                 $("#editUserCity").val(data2.city).change()
                 $('#editUserDistrict').removeAttr('disabled')
                 $("#editUserDistrict").val(data2.district)
                 $('#editUserWard').removeAttr('disabled')
             });
         });
     });

     // thành phố
     $.getJSON("{{url('json/tinh_tp.json')}}", function(data) {
         $('#editUserCity').html('<option>Chọn thành phố...</option>')
         $.each(data, function(indexInArray, valueOfElement) {
             $('#editUserCity').append('<option data-id="' + valueOfElement.code + '" value="' + valueOfElement.name_with_type + '">' + valueOfElement.name_with_type + '</option>')
         });
     })

     // tỉnh
     $('#editUserCity').change(function(e) {
         $('#editUserDistrict').removeAttr('disabled')
         $('#editUserWard').html('')
         cityID = $('#editUserCity').find(':selected').data('id')

         $('#editUserDistrict').html('<option>Chọn tỉnh...</option>')
         $('#editUserWard').html('<option>Chọn phường...</option>')
         $.getJSON("{{url('json/quan_huyen.json')}}", function(data) {
             $.each(data, function(indexInArray, valueOfElement) {
                 if (cityID == valueOfElement.parent_code) {
                     $('#editUserDistrict').append('<option data-id="' + valueOfElement.code + '" value="' + valueOfElement.name_with_type + '">' + valueOfElement.name_with_type + '</option>')
                 }
             });
         });
     });

     // phường
     $('#editUserDistrict').change(function(e) {
         $('#editUserWard').removeAttr('disabled')
         districtId = $('#editUserDistrict').find(':selected').data('id')

         $('#editUserWard').html('<option>Chọn phường...</option>')
         $.getJSON("{{url('json/xa_phuong.json')}}", function(data) {
             $.each(data, function(indexInArray, valueOfElement) {
                 if (districtId == valueOfElement.parent_code) {
                     $('#editUserWard').append('<option value="' + valueOfElement.name_with_type + '">' + valueOfElement.name_with_type + '</option>')
                 }
             });
         });
     })

     $('#editSubmit').click(function(e) {
         e.preventDefault();
         idUser = "{{Auth::user()->id}}"
         $.ajax({
             type: 'POST',
             url: "{{url('user')}}/" + idUser,
             data: $("#editForm").serialize(),
             success: function(response) {}
         });
     });
 </script>
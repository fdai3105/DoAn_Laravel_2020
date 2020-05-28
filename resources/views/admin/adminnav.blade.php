<!-- user header -->
<a href="" style="text-decoration: none">
    <div class="user-details">
        <img src="https://www.w3schools.com/howto/img_avatar.png" style="border-radius: 50%;width: 20%">
        <p>Hoàng Phi Đại</p>
    </div>
</a>
<div class="list-group">
    <a href="{{ route('admin') }}" class="list-group-item {{Route::currentRouteName() == 'admin' ? 'active' : ''}}">Sản Phẩm</a>
    <a href="{{ route('admin/brand') }}" class="list-group-item {{Route::currentRouteName() == 'admin/brand' ? 'active' : ''}}">Thương Hiệu</a>
    <a href="{{route('admin/category') }}" class="list-group-item {{Route::currentRouteName() == 'admin/category' ? 'active' : ''}}">Danh Mục</a>

    <a href="/" class="list-group-item" style="margin-top: 59vh"><i class="fa fa-arrow-left"></i> Back to Home</a>
</div>
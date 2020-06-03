@extends('home')

@section('body')
<div class="container" style="margin-top: 50px;">
    <div class="row">
        <div class="col-6">
            <img width="100%" src="{{$product->image}}">
        </div>
        <div class="col-6 product-item">
            <div style="display:flex">
                <h5>{{$product->category->name}}</h5>
                <h5>&nbsp;|&nbsp;</h5>
                <h5>{{$product->productBrand->name}}</h5>
            </div>
            <h4 class="text-title">{{$product->name}}</h4>
            <p class="text-price">{{number_format($product->price,0,'.','.')}}₫</p>
            <h5 style="margin-bottom:0px">Description</h5>
            <p class="text-desc">{{$product->desc}}</p>
            <h5 style="margin-bottom:0px">Reviews</h5>
            <div style="display:flex;vertical-align:center;margin-bottom: 16px;">
                <div>
                    @for($i = 0; $i < 5; ++$i) <i class="fa fa-star {{$product->vote<=$i?'': 'checked'}}" aria-hidden="true"></i>
                        @endfor
                </div>
            </div>
            <h5 style="margin-bottom:0px">Colors</h5>
            <p></p>
            <h5 style="margin-bottom:0px">Sizes</h5>
            <p></p>

            <button class="btn btn-dark add-to-cart">Thêm Vào Giỏ <i class="fa fa-cart-plus"></i></button>
        </div>
    </div>
</div>
@endsection
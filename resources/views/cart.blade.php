@extends('home')

<head>
    <title>Giỏ Hàng | fdBlog</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<style>
    p {
        margin-bottom: 0px !important;
    }
</style>
@section('body')
<div class="container" style="margin-top:30px">
    @if(count($cart))
    <table class="table table-hover">
        <thead>
            <tr class="bg-dark">
                <th scope="col" colspan="2">Sản phẩm</th>
                <th scope="col">Đơn giá</th>
                <th scope="col">Số lượng</th>
                <th scope="col">Số tiền</th>
                <th scope="col">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cart as $item)
            <tr>
                <td>
                    <img height="100px;" src="{{ $item->options->image }}">
                </td>
                <td>
                    <h5><a href="product/{{$item->name}}">{{ $item->name }}</a></h5>
                    <p>#{{ $item->id }}</p>
                </td>
                <td>
                    <p>{{ number_format($item->price)}} VNĐ</p>
                </td>
                <td>
                    <div style="display:flex">
                        <button class="btn btn-light decreaseQty" type="submit" data-id="{{$item->id}}"> + </button>
                        <input class="form-control" type="text" style="margin: 0 6px 0 6px;width: 45px;text-align: center;" name="quantity" value="{{$item->qty}}" autocomplete="off">
                        <button class="btn btn-light incrementQty" type="submit" data-id="{{$item->id}}"> + </button>
                    </div>
                </td>
                <td>
                    <p class="cart_total_price">{{ number_format($item->subtotal)}} VNĐ</p>
                </td>
                <td>
                    <button class="btn btn-danger" id="delete" data-id="{{$item->id}}"><i class="fa fa-times"></i></button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="row" style="margin:0px;text-align: right;align-items: center;justify-content: flex-end;">
        <p style="margin-right: 10px;">Tổng tiền hàng <br>({{count($cart)}} Sản phẩm)</p>
        <h4 style="margin-bottom: 0px;margin-right: 10px;">₫{{Cart::subtotal(0,',')}}</h4>
        <button class="btn btn-dark" id="checkout" style="padding: 13px 50px 13px 50px;">Thanh Toán</button>
    </div>
    @else
    <p>You have no items in the shopping cart</p>
    @endif
</div>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(".decreaseQty").on("click", function(e) {
            var id = $(this).data("id")
            $.ajax({
                type: "POST",
                url: "{{url('decreaseQty')}}",
                data: {
                    "id": id
                },
                success: function(data) {
                    location.reload();
                },
                error: function(data) {
                    alert(data);
                }
            });
        });

        $(".incrementQty").on("click", function() {
            var id = $(this).data("id")
            console.log(id)
            $.ajax({
                type: "POST",
                url: "{{url('incrementQty')}}",
                data: {
                    "id": id
                },
                success: function(data) {
                    location.reload();
                },
                error: function(data) {
                    alert(data);

                }
            });
        })

        $("#delete").on("click", function() {
            var id = $(this).data("id");
            $.ajax({
                type: "POST",
                url: "{{url('removeCart')}}",
                data: {
                    "id": id
                },
                success: function(data) {
                    location.reload();
                }
            });
        });

        $("#checkout").on("click", function() {
            $.ajax({
                type: "POST",
                url: "{{url('checkout')}}",
                // data: "note",
                success: function(data) {
                    location.reload();
                }
            });
        });

    });
</script>
@endsection
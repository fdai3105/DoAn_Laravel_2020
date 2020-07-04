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
                        <button data-id="{{$item->id}}" class="btn btn-light decreaseQty" type="submit"> - </button>
                        <input id="inputQty{{$item->id}}" data-id="{{$item->id}}" name="quantity" value="{{$item->qty}}" class="form-control" type="number" style="margin: 0 6px 0 6px;width: 45px;text-align: center;" autocomplete="off">
                        <button data-id="{{$item->id}}" class="btn btn-light incrementQty" type="submit"> + </button>
                    </div>
                </td>
                <td>
                    <p id="itemTotal{{$item->id}}">{{ number_format($item->subtotal)}} VNĐ</p>
                </td>
                <td>
                    <button class="btn btn-danger delete" data-id="{{$item->id}}"><i class="fa fa-times"></i></button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="row" style="margin:0px;text-align: right;align-items: center;justify-content: flex-end;">
        <p style="margin-right: 10px;">Tổng tiền hàng <br>({{count($cart)}} Sản phẩm)</p>
        <h4 id="total" style="margin-bottom: 0px;margin-right: 10px;">{{Cart::subtotal(0,',')}}₫</h4>
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

        function addCommas(nStr) {
            nStr += '';
            x = nStr.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + ',' + '$2');
            }
            return x1 + x2;
        }

        $('input[name="quantity"]').focusout(function(e) {
            var id = $(this).data("id")
            inputQty = $(this).val();
            if (inputQty < 1) {
                alert('Số lượng sản phẩm giới hạn từ 1 đến 50')
                $(this).val(1)
                return false
            }
            if (inputQty > 50) {
                alert('Số lượng sản phẩm giới hạn từ 1 đến 50')
                $(this).val(50)
                return false
            }

            $.ajax({
                type: "POST",
                url: "{{url('changeQty')}}",
                data: {
                    "id": id,
                    'qty': inputQty,
                },
                success: function(data) {
                    $('#inputQty' + id).val(data.qty)
                    $('#itemTotal' + id).html(addCommas(data.totalItem) + '₫')
                    $('#total').html(addCommas(data.total) + '₫')
                },
                error: function(data) {
                    alert(data);
                }
            });
        });

        // -
        $(".decreaseQty").on("click", function(e) {
            id = $(this).data("id")
            inputQty = $('#inputQty' + id)
            if (inputQty.val() < 1) {
                alert('Số lượng sản phẩm giới hạn từ 1 đến 50')
                inputQty.val(1)
                return false
            }
            if (inputQty.val() > 50) {
                alert('Số lượng sản phẩm giới hạn từ 1 đến 50')
                inputQty.val(50)
                return false
            }
            $.ajax({
                type: "POST",
                url: "{{url('decreaseQty')}}",
                data: {
                    "id": id
                },
                success: function(data) {
                    $('#inputQty' + id).val(data.qty)
                    $('#itemTotal' + id).html(addCommas(data.totalItem) + '₫')
                    $('#total').html(addCommas(data.total) + '₫')
                },
                error: function(data) {
                    alert(data);
                }
            });
        });

        // +
        $(".incrementQty").on("click", function() {
            var id = $(this).data("id")
            $.ajax({
                type: "POST",
                url: "{{url('incrementQty')}}",
                data: {
                    "id": id
                },
                success: function(data) {
                    $('#inputQty' + id).val(data.qty)
                    $('#itemTotal' + id).html(addCommas(data.totalItem) + '₫')
                    $('#total').html(addCommas(data.total) + '₫')
                    $('#cartCount').html(data.count)
                },
                error: function(data) {
                    alert(data);

                }
            });
        })

        $(".delete").on("click", function() {
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
            userId = '{{Auth::user()->id}}'
            $.get("{{url('user')}}/" + userId, function(data) {
                if (data.address_id == null) {
                    alert('Vui lòng cập nhập thông tin địa chỉ đầy đủ')
                    setData();
                    return false;
                }
            });
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
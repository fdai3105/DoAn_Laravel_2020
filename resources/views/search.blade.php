@extends('home')

@section('body')

<body>
    <div class="container-fluid" style="margin-top:30px">
        <h4 style="text-transform:uppercase">Tìm thấy {{count($search)}} kết quả cho '{{$key}}'</h4>

        @if (count($search) > 0)
        <div class="row">
            @foreach($search as $search)
            <div class="col-3 product">
                <a href="{{route('product',$search->name)}}">
                    <div class="border">
                        <img src="{{$search->image}}">
                        <div class="product-body">
                            <p id="cate">{{$search->productBrand->name}}</p>
                            <p id="name">{{$search->name}}</p>
                            <div class="row">
                                <div class="col-6" id="vote">
                                    @for($i = 0; $i < 5; ++$i) <i class="fa fa-star {{$search->vote<=$i?'': 'checked'}}" aria-hidden="true"></i>
                                        @endfor
                                </div>
                                <p class="col-6" id="price">{{number_format($search->price)}}₫</p>
                            </div>
                        </div>
                        <div class="overlay"></div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        @else
        <div class="" style="text-align: center;">
            <h4>Vui lòng nhập lại nhé bạn</h4>
        </div>
        @endif

    </div>
</body>
@endsection
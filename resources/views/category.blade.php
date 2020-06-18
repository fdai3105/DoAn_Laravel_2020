@extends('home')

@section('body')

<body>
    <div class="container-fluid" style="margin-top:30px">
        <h4 style="text-transform:uppercase">{{$category->name}}</h4>
        <div class="row">
            @foreach($category->product as $categoryFilter)
            <div class="col-3 product">
                <a href="{{route('product.show',$categoryFilter->name)}}">
                    <div class="border">
                        <img src="{{$categoryFilter->image}}">
                        <div class="product-body">
                            <p id="cate">{{$categoryFilter->productBrand->name}}</p>
                            <p id="name">{{$categoryFilter->name}}</p>
                            <div class="row">
                                <div class="col-6" id="vote">
                                    @for($i = 0; $i < 5; ++$i) <i class="fa fa-star {{$categoryFilter->vote<=$i?'': 'checked'}}" aria-hidden="true"></i>
                                        @endfor
                                </div>
                                <p class="col-6" id="price">{{number_format($categoryFilter->price)}}₫</p>
                            </div>
                        </div>
                        <div class="overlay"></div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</body>
@endsection
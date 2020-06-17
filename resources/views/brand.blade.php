@extends('home')

@section('body')
<body>
    <div class="container-fluid" style="margin-top:30px">
        <h4 style="text-transform:uppercase">{{$brandFilter->name}}</h4>
        <div class="row">
            @foreach($brandFilter->product as $brandFilter)
            <div class="col-3 product">
                <a href="{{route('product',$brandFilter->name)}}">
                    <div class="border">
                        <img src="{{$brandFilter->image}}">
                        <div class="product-body">
                            <p id="cate">{{$brandFilter->category->name}}</p>
                            <p id="name">{{$brandFilter->name}}</p>
                            <div class="row">
                                <div class="col-6" id="vote">
                                    @for($i = 0; $i < 5; ++$i) <i class="fa fa-star {{$brandFilter->vote<=$i?'': 'checked'}}" aria-hidden="true"></i>
                                        @endfor
                                </div>
                                <p class="col-6" id="price">{{number_format($brandFilter->price)}}₫</p>
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
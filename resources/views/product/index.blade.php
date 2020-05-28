@extends('layouts.master')

<!-- product hot -->
<div class="container-fluid bg-3 containerCustom">
    <div class="row">
        @foreach($products as $products)
        <div class="col-sm-3">
            <div class="card">
                <img class="card-img-top" src="{{$products->image}}" alt="Card image">
                <div class="card-body">
                    <p class="card-text">{{$products->productsBrand->name}}</p>
                    <h4 class="card-title">{{$products->name}}</h4>
                    <p style="text-align:right; font-size: 18px" class="card-text">{{$products->price}}00.000 ₫</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
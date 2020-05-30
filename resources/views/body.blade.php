@extends('layouts.master')
<style>
    body {
        background-color: #4d3534 !important;
    }
</style>
<!-- slide -->
<div class="container-fluid" style="width:100%; padding: 0px 0px 12px 0px;">
    <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="5000">
        <!-- Indicators -->
        <!-- <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol> -->

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <img src="https://i.imgur.com/abnARsD.png" alt="New york">
            </div>
            <div class="item">
                <img src="https://i.imgur.com/4zpKnVh.png" alt="New york">
            </div>
            <div class="item">
                <img src="https://i.imgur.com/p2Tousf.png" alt="New york">
            </div>
        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>

<div class="container-fluid twoOption">
    <div class="row">
        <div class="col-md-6 colImage1" style="height: 350px">
            <div class="col">
                <h1>FAST IS HERE
                </h1>
                <p>A collection of running shoes to suit all kinds of runners.</p>
                <button type="button" class="btn btn-light">Click here</button>
            </div>

        </div>
        <div class=" col-md-6 colImage2" style="height: 350px">
            <iframe width="717.600" height="350" src="https://www.youtube.com/embed/Rwk5PdpTxSU" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>
</div>

<!-- product hot -->
<div class="container-fluid bg-3 containerCustom">
    <h3 style="text-align: center;">Các sản phẩm hot trong ngày</h3><br>
    <div class="row">
        @foreach($products as $products)
        <div class="col-sm-3">
            <div class="card">
                <img class="card-img-top" src="{{$products->image}}" alt="Card image">
                <div class="card-body">
                    <p class="card-text">{{$products->productBrand->name}}</p>
                    <h4 class="card-title">{{$products->name}}</h4>
                    <p style="text-align:right; font-size: 18px" class="card-text">{{$products->price}}00.000 ₫</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- sale banner -->
<div class=".container-fluid" style="background-color: #EF4B50; text-align: center;color: #fff;
                                        padding-top: 20px;padding-bottom: 20px">
    <h1 style="font-weight: 800">Sale off 30%</h1>
    <p style="font-size:20px">Đừng chần chừ-thời gian có hạn</p>
</div>

<!-- slideshow banner -->
<div class="slideshow">
    <div class="sliding-background"></div>
</div>
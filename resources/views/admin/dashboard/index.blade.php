@extends('admin.index')

@section('content')
<div class="col-sm-10" style="background-color:white;margin-left: 16.69%; padding :0">
    <div class="container-fluid">
        <div class="row header">
            <img src="https://img.icons8.com/material/144/ffffff/home--v5.png" />
            <h5 style="vertical-align:middle">Dashboard</h4>
        </div>
    </div>
    <div class="container-fluid dashboard">
        <div class="row ">
            <div class="col-3">
                <a href="{{route('products.index')}}">
                    <div class="dashboard-item" style="background-color: dodgerblue;height: 125px;">
                        <div class="dashboard-overlay">
                            <p>Products</p>
                            <h4>{{count($products)}}</h4>
                            <span><i class="fa fa-chevron-right"></i>
                            </span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-3">
                <div class="dashboard-item" style="background-color: crimson;height: 125px;">
                    <a href="{{route('brands.index')}}">
                        <div class="dashboard-overlay">
                            <p>Brands</p>
                            <h4>{{count($brands)}}</h4>
                            <span><i class="fa fa-chevron-right"></i></span>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-3">
                <div class="dashboard-item" style="background-color: darkorange;height: 125px;">
                    <a href="{{route('categories.index')}}">
                        <div class="dashboard-overlay">
                            <p>Categories</p>
                            <h4>{{count($categories)}}</h4>
                            <span><i class="fa fa-chevron-right"></i></span>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-3">
                <div class="dashboard-item" style="background-color: grey;height: 125px;">
                    <a href="">
                        <div class="dashboard-overlay">
                            <p>Users</p>
                            <h4>50</h4>
                            <span><i class="fa fa-chevron-right"></i></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <canvas id="myChart"></canvas>
            </div>
            <div class="col-lg-6">
                <canvas id="myChart2"></canvas>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script>
    $(document).ready(function() {
        c = JSON.parse('{{$products}}'.replace(/&quot;/g, '"'))
        console.log(c);
        var chart = new Chart($('#myChart'), {
            type: 'line',
            data: {
                labels: ['2'],
                datasets: [{
                    label: 'My First dataset',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: ['2']
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    });
</script>
@endsection
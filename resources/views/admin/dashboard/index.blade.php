@extends('admin.index')

@section('content')
<div class="col-sm-10">
    <div class="container-fluid">
        <div class="row header">
            <img src="https://img.icons8.com/material/144/ffffff/home--v5.png" />
            <h5 style="vertical-align:middle">Dashboard</h5>
            <div class="col" style="text-align: end">
                <a style="color:white !important" href="{{ route('change-language', ['en']) }}">English</a>
                /
                <a style="color:white !important" href="{{ route('change-language', ['vi']) }}">Vietnamese</a>
            </div>
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
                <canvas id="doanhThu"></canvas>
            </div>
            <div class="col-lg-6">
                <canvas id="chartOrder"></canvas>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <canvas id="chartCate"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script>
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


    function doanhThu() {
        var result = null;
        $.ajax({
            type: "GET",
            url: "{{url('admin/doanhthu')}}",
            async: false,
            success: function(response) {
                result = response
            }
        });
        return result;
    }

    function countOrder() {
        var result = null;

        $.ajax({
            type: "GET",
            url: "{{url('admin/countOrderByMonth')}}",
            async: false,
            success: function(response) {
                result = response
            }
        });
        return result;
    }

    function countCate() {
        var result = null
        $.ajax({
            type: "GET",
            url: "{{url('admin/countCate')}}",
            async: false,
            success: function(response) {
                result = response
            }
        });
        return result
    }

    var doanhThu = {
        type: 'line',
        data: {
            labels: Object.keys(doanhThu()),
            datasets: [{
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: Object.values(doanhThu())
            }]
        },
        options: {
            tooltips: {
                callbacks: {
                    title: function(tooltipItem, data) {
                        return 'Tháng ' + tooltipItem[0].xLabel;

                    },
                    label: function(tooltipItem, data) {
                        return addCommas(tooltipItem.yLabel) + ' VND';
                    }
                }
            },
            legend: {
                display: false,
            },
            title: {
                display:true,
                text:"Doanh thu theo tháng:"
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        callback: function(values) {
                            return addCommas(values)
                        }
                    }
                }]
            }
        }
    };

    var chartOrder = {
        type: 'bar',
        data: {
            labels: Object.keys(countOrder()),
            datasets: [{
                backgroundColor: '#215871',
                borderColor: '#0F1C22',
                data: Object.values(countOrder()),
            }]
        },
        options: {
            tooltips: {
                callbacks: {
                    title: function(tooltipItem, data) {
                        return 'Tháng ' + tooltipItem[0].xLabel;

                    },
                    label: function(tooltipItem, data) {
                        return tooltipItem.yLabel + ' đơn hàng';
                    }
                }
            },
            legend: {
                display: false,
            },
            title: {
                display: true,
                text: 'Số đơn hàng theo tháng:'
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    };

    var chartCate = {
        type: 'doughnut',
        data: {
            labels: Object.keys(countCate()),
            datasets: [{
                backgroundColor: '#215871',
                borderColor: '#0F1C22',
                data: Object.values(countCate()),
            }]
        },
        options: {
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        var indice = tooltipItem.index;
                        return data.labels[indice] + ': ' + data.datasets[0].data[indice] + ' mặt hàng';
                    }
                }
            },
            legend: {
                display: false,
            },
            title: {
                display: true,
                text: 'Phân bố các danh mục hàng'
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    };

    $(document).ready(function() {

        new Chart($("#doanhThu"), doanhThu)
        new Chart($("#chartOrder"), chartOrder)
        new Chart($("#chartCate"), chartCate)
    });
</script>
@endsection
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>

<body>
    <table>
        <h2>Hiển thị db nè</h2>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Created Date</th>
        </tr>
        @foreach($fdai['product_brands'] as $key => $data)
        <tr>
            <th>{{$data->id}}</th>
            <th>{{$data->name}}</th>
            <th>{{$data->created_at}}</th>
        </tr>
        @endforeach
    </table>

    <table>
        <h2>Hiển thị db 2 nè</h2>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th style="width:50% ">Desc</th>
            <th>Price</th>
            <th>Product Brands</th>
            <th>Created Date</th>
        </tr>
        @foreach($fdai['products'] as $key => $data)
        <tr>
            <th>{{$data->id}}</th>
            <th>{{$data->name}}</th>
            <th>{{$data->desc}}</th>
            <th>{{$data->price}}</th>
            <th>{{$data->product_brands_id}}. {{$data->productsBrand->name}}</th>
            <th>{{$data->created_at}}</th>
        </tr>
        @endforeach
    </table>
</body>

</html>
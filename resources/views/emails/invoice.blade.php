<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Invoice</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12pt;
            margin: 0;
            padding: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 5px;
            border: 1px solid black;
            text-align: left;
        }
        th {
            background-color: #eee;
        }
        .text-right {
            text-align: right;
        }
        h1 {
            font-size: 24pt;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .logo {
            float: left;
            margin-right: 20px;
        }
        .header {
            overflow: hidden;
            margin-bottom: 20px;
        }
        .address {
            float: left;
            width: 50%;
        }
        .invoice-details {
            float: right;
            text-align: right;
            width: 50%;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" width="100">
        </div>
        <div class="address">
            <h2>Kayise IT</h2>
            <p>39B Nelbro Building, Mbombela, 1200</p>
            <p>0123456789</p>
            <p>info@kayiseit.co.za</p>
        </div>
        <div class="invoice-details">
            <h1>Invoice</h1>
            <p>Date: {{ $quotation->created_at }}</p>
            <p>Invoice Number: {{ $quotation->quotation_no }}</p>
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>1</td>
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->price }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="text-right">Total</td>
                <td>{{ $quotation->total_price }}</td>
            </tr>
            
        </tfoot>
    </table>
</body>
</html>

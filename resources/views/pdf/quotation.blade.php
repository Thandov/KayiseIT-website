<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
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
  display: block;
  margin: 0 auto;
  text-align: center;
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
    </div>
    
            <h2>Kayise IT</h2>
            <p>39B Nelbro Building, Mbombela, 1200</p>
            <p>0123456789</p>
            <p>info@kayiseit.co.za</p>
        
    
            <h1>Quotation</h1>
            <p>Date: {{ $quotation->created_at }}</p>
            <p>Quotation Number: {{ $quotation->quotation_no }}</p>
        
    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th>Unit Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->qty }}</td>
                    <td>{{ $item->sub_total }}</td>
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
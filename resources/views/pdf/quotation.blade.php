<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0 20px;
            /* Added more padding to the sides */
            background-color: #f4f4f4;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            max-width: 100px;
            height: auto;
        }

        .company-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .company-info p {
            margin: 0;
        }

        .invoice-details {
            text-align: right;
        }

        .invoice-details p {
            margin: 0;
        }

        .title {
            font-size: 24px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            /* Added more padding */
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .text-right {
            text-align: right;
        }

        .total-row {
            font-weight: bold;
        }

        .vat-row {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
            <h1>Kayise IT</h1>
        </div>

        <div class="company-info">
            <div class="address">
                <p>39B Nelbro Building, Mbombela, 1200</p>
                <p>0123456789</p>
                <p>info@kayiseit.co.za</p>
            </div>
            <div class="invoice-details">
                <p>Date: {{ $quotation->created_at }}</p>
                <p>Quotation Number: {{ $quotation->quotation_no }}</p>
            </div>
        </div>

        <h2 class="title">Quotation</h2>

        <table>
            <thead>
                <tr>
                    <th>Item</th> <!-- Changed "Description" to "Item" -->
                    <th>Unit Price</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
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
                    <td colspan="3" class="text-right">Subtotal</td>
                    <td class="total-row">{{ $quotation->subtotal }}</td>
                </tr>
                <tr>
                    <td colspan="3" class="text-right">VAT (20%)</td>
                    <td class="vat-row">{{ $quotation->vat }}</td>
                </tr>
                <tr>
                    <td colspan="3" class="text-right">Total</td>
                    <td class="total-row">{{ $quotation->total_price }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>

</html>
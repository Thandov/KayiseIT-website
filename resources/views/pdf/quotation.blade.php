<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,800;1,300&display=swap');

        @font-face {
            font-family: "Montserrat";
            font-weight: normal;
            font-style: normal;
            src: url("../fonts/montserrat/Montserrat-Regular.ttf") format("truetype");
        }

        /* Montserrat-Bold */
        @font-face {
            font-family: "Montserrat-Bold";
            font-weight: 700;
            font-style: normal;
            src: url("../fonts/montserrat/Montserrat-Bold.ttf") format("truetype");
        }

        * {
            font-family: "Montserrat", sans-serif;
        }

        body {
            font-family: "Montserrat", sans-serif;
            margin: 0;
            padding: 0 20px;
            /* Added more padding to the sides */
            background-color: #fff;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 15px;
            background-color: #fff;
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

        .nobord {
            border: none;
            border-collapse: collapse;
            /* Optional: This removes spacing between table cells */
        }
    </style>
</head>

<body>
    <div class="container">
        <table style="border: none; margin: 0;">
            <tr style="border: none;">
                <td valign="top" style="border: none; width: 50%">
                    <div class="header" style="position: relative; background: red; height: 50px">
                        <img src="@php echo $pic ?? '' @endphp" style="position: absolute; left: 0; height: 100%; width: auto">
                    </div>
                </td>
                <td valign="top" align="right" style="border: none; width: 50%">
                    <h1 style="padding: 0; margin: 0"># {{ $quotation->quotation_no }}</h1>

                </td>
            </tr>
        </table>
        <table style="border: none;">
            <tr style="border: none;">
                <td valign="top" style="border: none; width: 50%">
                    <div>
                        <h5 style="background: green; padding: 1px; color: #fff">Bill To</h5>
                        <p><span style="font-weight: 700">Name:</span> {{ $quotation->created_at }}</p>
                        <p><span style="font-weight: 700">Company Name:</span> {{ $quotation->quotation_no }}</p>
                        <p><span style="font-weight: 700">City:</span> {{ $quotation->quotation_no }}</p>
                        <p><span style="font-weight: 700">Phone:</span> {{ $quotation->quotation_no }}</p>
                    </div>

                </td>
                <td valign="top" align="right" style="border: none; width: 50%">
                    <p><span style="font-weight: 700">Date:</span> {{ $quotation->created_at }}</p>
                    <p><span style="font-weight: 700">Quotation #:</span> {{ $quotation->quotation_no }}</p>
                    <p>39B Nelbro Building, Mbombela, 1200</p>
                    <p>+27 87702 2625</p>
                    <p>info@kayiseit.co.za</p>
                </td>
            </tr>
        </table>
        <br><br>
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
                    <td>{{ $item->item }}</td>
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
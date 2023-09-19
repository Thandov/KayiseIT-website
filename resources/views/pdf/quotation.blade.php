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
            margin: 0;
            padding: 0;
        }

        html {
            height: 100%;
            width: 100%;
        }

        body {
            background-color: blue;
            font-family: "Montserrat", sans-serif;
            margin: 0;
            padding: 0 20px;
            /* Added more padding to the sides */
            height: 50%;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 15px;
            background-color: #fff;
        }

        p {
            padding: 0;
            margin: 0;
        }


        table {
            padding: 0;
            margin: 0;
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
    <div style="position: absolute; top: 0; left: 0; right: 0; text-align: center;">
        Your Header Content Goes Here
    </div>
    <div class="container">
        <table style="border-bottom: 5px solid #22c55e; margin: 0;">
            <tr style="border: none;">
                <td valign="top" style="border: none; width: 50%">
                    <div class="header" style="position: relative; height: 50px">
                        <img src="@php echo $pic ?? '' @endphp" style="position: absolute; left: -25px; top: -40px; height: 200%; width: auto">
                    </div>
                </td>
                <td valign="top" style="border: none; width: 50%; text-align: right;">
                    <h1 style="padding: 0; margin: 0"># {{ $quotation->quotation_no }}</h1>
                </td>
            </tr>
        </table>
        <table style="border: none;">
            <tr style="border: none;">
                <td valign="top" style="border: none; width: 50%">
                    <p style="color: #22c55e; font-weight: bold; margin: 0; padding: 0">Bill To</p>
                </td>
                <td valign="top" style="border: none; width: 50%">
                </td>
            </tr>
            <tr style="border: none;">
                <td valign="top" style="border: none; width: 50%">
                    <div>
                        <p><span style="font-weight: 700">Name:</span> {{ $client->name }}</p>
                        <p><span style="font-weight: 700">Company Name:</span> {{ $client->name }}</p>
                        <p><span style="font-weight: 700">City:</span> {{ $client->name }}</p>
                        <p><span style="font-weight: 700">Phone:</span> {{ $client->name }}</p>
                    </div>
                </td>
                <td valign="top" style="border: none; width: 50%; text-align: right;">
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
                <tr>
                    <td>
                        <p>{{ $items->item }}</p>
                    </td>
                    <td>
                        <p>{{ $items->price }}</p>
                    </td>
                    <td>
                        <p>{{ $items->qty }}</p>
                    </td>
                    <td>
                        <p>{{ $items->sub_total }}</p>
                    </td>
                </tr>
                @foreach($extraoptions as $extraoption)
                <tr>
                    <td>
                        <p>{{ $extraoption->item }}</p>
                    </td>
                    <td>
                        <p>{{ $extraoption->price }}</p>
                    </td>
                    <td>
                        <p>{{ $extraoption->qty }}</p>
                    </td>
                    <td>
                        <p>{{ $extraoption->sub_total }}</p>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-right">VAT (15%)</td>
                    <td class="vat-row">{{ $quotation->vat }}</td>
                </tr>
                <tr>
                    <td colspan="3" class="text-right">Total</td>
                    <td class="total-row">{{ $quotation->total_price }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
    <div style="position: absolute; bottom: 0; left: 0; right: 0; text-align: center;">
        Page {PAGE_NUM} of {PAGE_COUNT}
    </div>
</body>

</html>
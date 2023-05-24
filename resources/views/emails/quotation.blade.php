<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Invoice</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12pt;
            margin: 20px;
            padding: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 5px;
            border: 1px solid black;
            text-align: left;
        }

        th {
            background-color: #22C55E;
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
            text-align: left;
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

        .deposit {
            text-align: center;
            font-weight: bold;
        }

        .span {
            font-weight: bold;
        }

        .footer {
            bottom: 0;
            left: 0;
            background-color: #22C55E;
            padding: 10px;
            text-align: center;
        }

        .top{
            text-align: center;
            background-color: #eaeaea;
            padding: 20px;
        }
    </style>
</head>

<body>

    <div class="top">
        <h1 style="font-size: 18pt; font-weight: bold;">Thank you for your Quotation Request,
            {{ auth()->user()->name }}.
        </h1>
        <p>Please find below Your Quotation</p>
        <a href="https://kayiseit.com/services">cc</a>
    </div>


    <div class="header">
        <div class="logo" style="float: left;">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" width="100">
        </div>
        <div style="float: right; text-align: right;">
            <h1 style="font-size: 18pt; font-weight: bold;">Quotation Number: {{ $quotation->quotation_no }}</h1>
        </div>
    </div>


    <div class="header">
        <div class="address">
            <h2>Kayise IT</h2>
            <p><span class="span">Tel :</span>+27 87 702 2625</p>
            <p><span class="span">Email :</span>info@kayiseit.com</p>
            <p><span class="span">VAT :</span>4450296860</p>
            <p><span class="span">Address :</span>Office 02, 2nd floor, 39B Brown street, Mbombela, 1201</p>
        </div>
    </div>
    <div class="header">
        <div class="invoice-details">
            <p><span class="span">Invoice Date :</span>{{ $quotation->created_at }}</p>
            <p><span class="span">Account Holder :</span>{{ auth()->user()->name }}</p>
            <p><span class="span">Email :</span>{{ auth()->user()->email }}</p>
        </div>
    </div>

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
            @foreach($items as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->price }}</td>
                <td>{{ $item->qty }}</td>
                <td>{{ $item->sub_total }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3" class="text-right">Subtotal</td>
                <td>{{ $total_price }}</td>
            </tr>
            <tr>
                <td colspan="3" class="text-right">VAT (15%)</td>
                <td>{{ $vat_total }}</td>
            </tr>
            <tr>
                <td colspan="3" class="text-right"><span class="span">Total</span></td>
                <td><span class="span">{{ $quotation->total_price }}</span></td>
            </tr>
        </tbody>
    </table>



    <div class="header">
        <div class="deposit">
            <p><span class="span">A 50% deposit is required in order to begin the project. Remaining 50% can be paid up
                    in full after the project is done. This quotation is valid for 30 days from the date
                    generated.</span></p>
        </div>
    </div>


    <div class="header">
        <div class="bank">
            <h2>Banking Details</h2>
            <p><span class="span">Bank Name :</span>First National Bank (FNB)</p>
            <p><span class="span">Acc Number :</span>62764618959</p>
            <p><span class="span">Acc Holder :</span>KAYISE IT (PTY)LTD</p>
            <p><span class="span">Branch :</span>250655</p>
            <p><span class="span">Reference :</span>{{ auth()->user()->name }} - {{ auth()->user()->email }} </p>
        </div>
    </div>

    <div class="footer">
        <p>Thank you for your Business!</p>
        <p>KAYISE IT 39B Brown street, Mbombela, 1201, Phone: +27877022625</p>
        <p>Generated Using KIT Accounting Solution.</p>
    </div>

</body>

</html>
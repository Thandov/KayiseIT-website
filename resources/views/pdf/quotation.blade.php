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
            src: url("../fonts/Montserrat-Regular.ttf") format("truetype");
        }

        /* Montserrat-Bold */
        @font-face {
            font-family: "Montserrat-Bold";
            font-weight: 700;
            font-style: normal;
            src: url("../fonts/Montserrat-Bold.ttf") format("truetype");
        }

        * {
            font-family: "Montserrat", sans-serif !important;
            margin: 0;
            padding: 0;
        }

        html {
            height: 100% !important;
            width: 100% !important;
        }

        body {
            font-family: "Montserrat", sans-serif;
            margin: 0 !important;
            padding: 0 !important;
            height: 100% !important;
        }

        .footer {
            bottom: 0;
            left: 0;
            background-color: #f2f2f2;
            padding: 10px;
            text-align: center;
            margin-top: 30px;
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

        .bold {
            font-weight: bold;
        }

        .green {
            background-color: #22c55e;
        }

        .page-break {
            page-break-before: always;
        }

        .header {
            overflow: hidden;
            margin-bottom: 20px;
        }

        .bank {
            margin-top: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container content">
        <div class="header">
            <div class="logo" style="float: center; width: 100px;">
                <!-- <img src="{{ asset('images/logo.png') }}"> -->
            </div>
        </div>
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
                        <p><span style="font-weight: 700">Email:</span> {{ $client->email }}</p>
                        <!-- <p><span style="font-weight: 700">City:</span> {{ $client->name }}</p>
                        <p><span style="font-weight: 700">Phone:</span> {{ $client->name }}</p> -->
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
        <table style="padding-top: 20px;">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Unit Price</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr>
                    <td>
                        <p>{{ $item->item }}</p>
                    </td>
                    <td>
                        <p>{{ $item->price }}</p>
                    </td>
                    <td>
                        <p>{{ $item->qty }}</p>
                    </td>
                    <td>
                        <p>{{ $item->sub_total }}</p>
                    </td>
                </tr>
                @endforeach
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
                    <td class="bold">{{ $quotation->vat }}</td>
                </tr>
                <tr>
                    <td colspan="3" class="text-right">Total</td>
                    <td class="bold">{{ $quotation->total_vat }}</td>
                </tr>
            </tfoot>
        </table>

        <div class="bank">
            <h2>Banking Details</h2>
            <p><span style="font-weight: 700">Bank Name :</span>First National Bank (FNB)</p>
            <p><span style="font-weight: 700">Acc Number :</span>62764618959</p>
            <p><span style="font-weight: 700">Acc Holder :</span>KAYISE IT (PTY)LTD</p>
            <p><span style="font-weight: 700">Branch :</span>250655</p>
            <p><span style="font-weight: 700">Reference :</span>Name & Surname/Company Name</p>
        </div>

        <div class="footer">
            <p>Thank you for your Business!</p>
            <p>KAYISE IT 39B Brown street, Mbombela, 1201, Phone: +27877022625</p>
            <p>Generated Using KIT Accounting Solution.</p>
        </div>
    </div>
</body>
<!-- JavaScript to dynamically add page breaks when sections exceed a certain height
<script>
    window.addEventListener('beforeprint', function() {
        addPageBreaksForSections();
    });

    function addPageBreaksForSections() {
        var content = document.querySelector('.content');
        var footer = document.querySelector('.footer');

        if (!content || !footer) {
            return;
        }

        var pageHeight = window.innerHeight;
        var sections = content.querySelectorAll('.section');
        var currentPageHeight = 0;

        sections.forEach(function(section) {
            var sectionHeight = section.clientHeight;

            // Check if adding this section would exceed the page height
            if (currentPageHeight + sectionHeight > pageHeight) {
                // Add a page break before this section
                section.insertAdjacentHTML('beforebegin', '<div class="page-break"></div>');
                currentPageHeight = 0; // Reset the current page height
            }

            currentPageHeight += sectionHeight;

            // Add a <p> tag to display the section height
            var pTag = document.createElement('p');
            pTag.innerText = 'Section Height: ' + sectionHeight + 'px';
            section.appendChild(pTag);
        });
    }
</script> -->

</html>
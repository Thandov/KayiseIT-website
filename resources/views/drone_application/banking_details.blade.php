<x-app-layout>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            /* Adjust margin as needed */
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
            /* Adjust background color as needed */
        }

        .text-right {
            text-align: right;
        }

        .span {
            font-weight: bold;
            /* Adjust font weight as needed */
        }
    </style>
    <div class="flex justify-content-center  bg-slate-100">
        <div class="w-full sm:max-w-md my-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <h1 class="my-4">Thank You For Applying</h1>
            <p>You application will be finalized as soon as the deposit has been paid. A copy of the quotation and our banking details have also been sent to you via email</p>
            <h2>Summary:</h2>
            <p>Quotation Number: {{ $quotationData['quotation_no'] }}</p>
            <table>
                <thead>
                    <tr>
                        <th>Service</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Drone Workshop 1</td>
                        <td>{{ $quotationData['total'] }}</td>
                    </tr>
                    <tr>
                        <td class="text-right">Subtotal</td>
                        <td>R{{ $quotationData['total'] }}</td>
                    </tr>
                    <tr>
                        <td class="text-right">VAT (15%)</td>
                        <td>R{{ $quotationData['vat'] }}</td>
                    </tr>
                    <tr>
                        <td class="text-right"><span class="span">Total</span></td>
                        <td><span class="span">R{{ $quotationData['total_vat'] }}</span></td>
                    </tr>
                </tbody>
            </table>

            <h2 class="my-4">Banking Details:</h2>
            <p><span class="span">Bank Name :</span>First National Bank (FNB)</p>
            <p><span class="span">Acc Number :</span>62764618959</p>
            <p><span class="span">Acc Holder :</span>KAYISE IT (PTY)LTD</p>
            <p><span class="span">Branch :</span>250655</p>
            <p><span class="span">Reference :</span>{{ auth()->user()->name }}</p>

            <a href="{{ url('/profile') }}" class="bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600">FINISH</a>
        </div>
    </div>

</x-app-layout>
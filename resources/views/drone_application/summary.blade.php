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
            <p>You application will be finalized as soon as the deposit has been paid.</p>
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

            <a href="{{ url('/profile') }}" class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">FINISH</a>
            <a href="/dashboard/download_quotation/{{ $quotationData['quotation_no'] }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-slate-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 my-3">Download</a>
        </div>
    </div>

</x-app-layout>
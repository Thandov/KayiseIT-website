<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OzowPaymentController extends Controller
{
    public function initiatePayment()
   {
    $siteCode = 'TSTSTE0001';
    $privateKey = '215114531AFF7134A94C88CEEA48E';
    $apiKey = 'EB5758F2C3B4DF3FF4F2669D5FF5B';

        $postData = [
            'SiteCode' => $siteCode,
            'CountryCode' => 'ZA',
            'CurrencyCode' => 'ZAR',
            'Amount' => 0.01,
            'TransactionReference' => 'Merchant-Unique-Ref',
            'BankReference' => 'UniqueRef-20-Or-Less',
            'CancelUrl' => 'http://test.i-pay.co.za/responsetest.php',
            'ErrorUrl' => 'http://test.i-pay.co.za/responsetest.php',
            'SuccessUrl' => 'http://test.i-pay.co.za/responsetest.php',
            'NotifyUrl' => 'http://test.i-pay.co.za/responsetest.php',
            'IsTest' => 'false',
        ];

        $hashString = strtolower(implode('', $postData) . $privateKey);
        $hashCheck = hash('sha512', $hashString);
        $postData['HashCheck'] = $hashCheck;

        $ozowResult = $this->getPaymentLinkModel($postData, $apiKey);

        if (!empty($ozowResult->errorMessage)) {
            return response()->json(['error' => $ozowResult->errorMessage], 400);
        }

        return redirect()->away($ozowResult->url);
    }

    function getPaymentLinkModel($postData, $apiKey)
{
    $jsonRequest = json_encode($postData);

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Accept: application/json',
        'ApiKey:' . $apiKey,
        'Content-Type: application/json'
    ));

    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonRequest);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, 'https://api.ozow.com/postpaymentrequest');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $requestResult = curl_exec($ch);

    if ($requestResult === false) {
        die('Error generating Ozow URL: curl error');
    }

    return json_decode($requestResult);
}
}
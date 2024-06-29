<?php

namespace App\Http\Controllers;

use App\Models\MpesaTransaction;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class MpesaTransactions extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pay');
    }
    public function index1(){
        dd("one");
        return view('paid');
    }
    /**
     * pay 
     */

     public function pay(){
            $client = new Client();

            $businessShortCode = 174379;
            $password = 'your_password';
            $timestamp = date('YmdHis');
            $amount = 1; // example amount
            $partyA = '0723892001'; // client's phone number
            $partyB = $businessShortCode;
            $phoneNumber = $partyA;
            $callBackURL = 'https://your-app.com/callback'; // URL to receive payment callback
            $accountReference = 'your_account_reference';
            $transactionDesc = 'Ride payment';

            $stkPushRequest = [
                'BusinessShortCode' => $businessShortCode,
                'Password' => $password,
                'Timestamp' => $timestamp,
                'TransactionType' => 'CustomerPayBillOnline',
                'Amount' => $amount,
                'PartyA' => $partyA,
                'PartyB' => $partyB,
                'PhoneNumber' => $phoneNumber,
                'CallBackURL' => $callBackURL,
                'AccountReference' => $accountReference,
                'TransactionDesc' => $transactionDesc,
            ];

            $response = $client->post('https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest', [
                'json' => $stkPushRequest,
            ]);

            $responseData = json_decode($response->getBody()->getContents(), true);

            dd($responseData);
            return view("paid");
     }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(MpesaTransaction $mpesaTransaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MpesaTransaction $mpesaTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MpesaTransaction $mpesaTransaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MpesaTransaction $mpesaTransaction)
    {
        //
    }
}

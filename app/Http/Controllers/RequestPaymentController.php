<?php

namespace App\Http\Controllers;

use App\Payment;
use App\Request as PaymentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Mollie\Api\Exceptions\ApiException;
use Mollie\Api\MollieApiClient;

class RequestPaymentController extends Controller
{
    public function index($id)
    {
        $request = PaymentRequest::find($id);

        if (!isset($request)) {
            return redirect('home');
        }

        return view('payrequest/index', ['request' => $request]);
    }

    public function step2($id)
    {
        $request = PaymentRequest::find($id);

        if (!isset($request)) {
            return redirect('home');
        }

        try {
            $mollie = new MollieApiClient;
            $mollie->setApiKey(env('MOLLIE_API_KEY'));
        } catch (ApiException $e) {
        }

        $currencies = [
            ['name' => 'Euro', 'iso' => 'EUR'],
            ['name' => 'United States dollar', 'iso' => 'USD'],
            ['name' => 'Great British Pound', 'iso' => 'GBP']
        ];

        $methods = $mollie->methods->get("ideal", ["include" => "issuers,pricing"]);

        return view('payrequest/choosebank',
            [
                'currencies' => $currencies,
                'request' => $request,
                'methods' => $methods
            ]);
    }

    /**
     * @param $id
     * @param Request $r
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function step3($id, Request $r)
    {
        $r->validate(
            [
                'currency' => 'required|min:3|max:3',
                'bank' => 'required'
            ]
        );

        $request = PaymentRequest::find($id);

        if (!isset($request)) {
            return redirect('home');
        }

        if (env('NGROK_ADDRESS') == null || env('NGROK_ADDRESS') == "") {
            die('Please enter a valid HTTP address in the env');
        }

        try {
            $mollie = new MollieApiClient;
            $mollie->setApiKey(env('MOLLIE_API_KEY'));
        } catch (ApiException $e) {
        }

        // Get the issuer id from the request
        $issuer_id = Input::get('bank');
        $selected_currency = Input::get('currency');



        $payment_amount = number_format($currency_amount, 2, ".", "");

        try {
            $payment = $mollie->payments->create(
                [
                    "amount" => [
                        "currency" => $selected_currency,
                        "value" => $payment_amount
                    ],
                    "description" => "MoneyQ",
                    "redirectUrl" => env("NGROK_ADDRESS") . "/pay/" . $request->id . "/finish",
                    "webhookUrl" => env("NGROK_ADDRESS") . "/payment/webhook/",
                    "metadata" => [
                        "request_id" => $request->id,
                        "user_id" => Auth::user()->id,
                    ],
                    "method" => "ideal",
                    "issuer" => $issuer_id
                ]
            );

            return redirect($payment->getCheckoutUrl());
        } catch (ApiException $e) {
        }
    }

    public function finished($id)
    {
        return view('payrequest/finished');
    }

    public function webhook()
    {
        if (!isset($_POST['id'])) {
            die('Please attach an ID');
        }

        try {
            $mollie = new MollieApiClient;
            $mollie->setApiKey(env('MOLLIE_API_KEY'));
            $mollie_payment = $mollie->payments->get($_POST['id']);
        } catch (ApiException $e) {
        }

        if (!isset($mollie_payment)) {
            die('This payment was not found');
        }

        $request_id = Str::random(50);

        $payment = Payment::create(
            [
                'id' => $request_id,
                'request_id' => $mollie_payment->metadata->request_id,
                'user_id' => $mollie_payment->metadata->user_id,
                'mollie_payment_id' => $_POST['id']
            ]
        );

        response()->json(['success' => true], 200);
    }
}

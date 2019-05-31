<?php

namespace App\Http\Controllers;

use App\Request;
use Mollie\Api\Exceptions\ApiException;
use Mollie\Api\MollieApiClient;

class RequestPaymentController extends Controller
{
    public function Index($id)
    {
        $request = Request::find($id);

        if (!isset($request))
            return redirect('home');

        return view('payrequest/index', ['request' => $request]);
    }

    public function Step2($id)
    {
        $request = Request::find($id);

        if (!isset($request))
            return redirect('home');

        try {
            $mollie = new MollieApiClient;
            $mollie->setApiKey(env('MOLLIE_API_KEY'));
        } catch (ApiException $e) {
        }

        $methods = $mollie->methods->get("ideal", ["include" => "issuers,pricing"]);

        return view('payrequest/choosebank', ['request' => $request, 'methods' => $methods]);
    }

    public function Step3($id, $issuer_id)
    {
        $request = Request::find($id);

        if (!isset($request))
            return redirect('home');

        if (env('NGROK_ADDRESS') == null || env('NGROK_ADDRESS') == "")
            die('Please enter a valid HTTP address in the env');

        try {
            $mollie = new MollieApiClient;
            $mollie->setApiKey(env('MOLLIE_API_KEY'));
        } catch (ApiException $e) {
        }

        try {
            $payment = $mollie->payments->create([
                "amount" => [
                    "currency" => "EUR",
                    "value" => number_format($request->amount, 2, ".", "")
                ],
                "description" => "MoneyQ",
                "redirectUrl" => env("NGROK_ADDRESS") . "/pay/" . $request->id . "/finish",
                "webhookUrl" => env("NGROK_ADDRESS") . "/payment/webhook/",
                "metadata" => [
                    "request_id" => $request->id,
                ],
                "method" => "ideal",
                "issuer" => $issuer_id
            ]);

            return redirect($payment->getCheckoutUrl());
        } catch (ApiException $e) {
        }
    }

    public function Finished($id)
    {
        return view('payrequest/finished');
    }
}
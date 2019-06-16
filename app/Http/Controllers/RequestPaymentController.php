<?php

namespace App\Http\Controllers;

use App\Payment;
use App\Request as PaymentRequest;
use danielme85\CConverter\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Mollie\Api\Exceptions\ApiException;
use Mollie\Api\MollieApiClient;

class RequestPaymentController extends Controller
{
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function index($id)
    {
        $request = PaymentRequest::find($id);

        if (!isset($request)) {
            return redirect('home');
        }

        return view('payrequest/index', ['request' => $request]);
    }

    /**
     * @param $id
     * @param Request $r
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     * @throws ApiException
     */
    public function chooseMethod($id, Request $r)
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
            ['name' => 'United States Dollar', 'iso' => 'USD'],
            ['name' => 'Great British Pound', 'iso' => 'GBP']
        ];

        $amount = number_format($request->amount, 2, ".", "");
        $selected_currency = Input::get('currency') ?: 'EUR';

        $providers = $mollie->methods->all(
            ['amount' => ['value' => $amount, 'currency' => $selected_currency]]
        );

        return view(
            'payrequest/choose_method',
            [
                'providers' => $providers,
                'request' => $request,
                'currencies' => $currencies
            ]
        );
    }

    /**
     * @param $id
     * @param Request $r
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function chooseMethodPost($id, Request $r)
    {
        $r->validate(
            [
                'provider' => 'required'
            ]
        );

        $request = PaymentRequest::find($id);

        if (!isset($request)) {
            return redirect('home');
        }

        $selected_currency = Input::get('currency') ?: 'EUR';

        return redirect(
            route(
                'pay_chooseissuer',
                [
                    $id, Input::get('provider'), 'currency' => $selected_currency
                ]
            )
        );
    }

    /**
     * @param $id
     * @param $provider
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function chooseIssuer($id, $provider)
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

        try {
            $mollie_provider = $mollie->methods->get(
                $provider,
                ["include" => "issuers,pricing"]
            );
        } catch (ApiException $e) {
            return redirect(route('pay_choosemethod', $id));
        }

        return view(
            'payrequest/chooseissuer',
            [
                'provider' => $mollie_provider,
                'request' => $request,
                'selected_method' => $provider,
                'selected_currency' => Input::get('currency') ?: 'EUR'
            ]
        );
    }

    /**
     * @param $id
     * @param Request $r
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function chooseIssuerPost($id, $provider, Request $r)
    {
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

        $selected_currency = Input::get('currency') ?: 'EUR';

        $correct_amount = Currency::conv(
            'EUR',
            $selected_currency,
            $request->amount
        );

        $correct_amount = number_format($correct_amount, 2, ".", "");

        // Get the issuer id from the request
        $issuer_id = Input::get('issuer');

        try {
            $payment = $mollie->payments->create(
                [
                    "amount" => [
                        "currency" => $selected_currency,
                        "value" => $correct_amount
                    ],
                    "description" => "MoneyQ",
                    "redirectUrl" =>
                        env("NGROK_ADDRESS") . "/pay/" . $request->id . "/finish",
                    "webhookUrl" => env("NGROK_ADDRESS") . "/payment/webhook/",
                    "metadata" => [
                        "request_id" => $request->id,
                        "user_id" => Auth::user()->id,
                    ],
                    "method" => $provider,
                    "issuer" => $issuer_id
                ]
            );

            return redirect($payment->getCheckoutUrl());
        } catch (ApiException $e) {
            // Go back when mollie creates an error
//            return response()->json($e->getMessage());
            return back();
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function finished($id)
    {
        return view('payrequest/finished');
    }

    /**
     * @description The webhook for mollie, to verify payments
     */
    public function webhook()
    {
        if (empty($_POST['id'])) {
            die('Please attach an ID');
        }

        try {
            $mollie = new MollieApiClient;
            $mollie->setApiKey(env('MOLLIE_API_KEY'));
            $mollie_payment = $mollie->payments->get($_POST['id']);
        } catch (ApiException $e) {
        }

        if (empty($mollie_payment)) {
            die('This payment was not found');
        }

        $payment_id = Str::random(50);

        // Create a new payment
        $payment = Payment::create(
            [
                'id' => $payment_id,
                'request_id' => $mollie_payment->metadata->request_id,
                'user_id' => $mollie_payment->metadata->user_id,
                'amount' => $mollie_payment->amount->value,
                'mollie_payment_id' => $_POST['id']
            ]
        );

        response()->json(['success' => true], 200);
    }
}

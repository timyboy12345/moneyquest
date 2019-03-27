<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Mollie\Api\MollieApiClient;


Route::get('/', function () {
    return view('welcome');
});

Route::get('login', function() {
    return view('login/index');
})->name('login');

Route::get('/mollie', function () {
    $payment_id = "12345";

    $mollie = new MollieApiClient();
    $mollie->setApiKey("test_dGjvGh2bqaVStDgJDGbeqnbqj2qJzm");

    try {
        $payment = $mollie->payments->create([
            "amount" => [
                "currency" => "EUR",
                "value" => "10.00"
            ],
            "description" => "My first API payment",
            "redirectUrl" => "http://127.0.0.1:8000/return/" . $payment_id,
            "webhookUrl" => "http://127.0.0.1:8000/webhook/"
        ]);

//    $payment->getCheckoutUrl();
        return redirect($payment->getCheckoutUrl());
    } catch (Exception $e) {
        info($e);
        return view('mollie/error', ["error" => $e]);
    }
});

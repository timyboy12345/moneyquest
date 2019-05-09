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

use Illuminate\Support\Facades\Route;
use Mollie\Api\MollieApiClient;


Route::get('/', 'HomeController@Home')->name('home');

Route::get('/lang/{lang}', function ($lang) {
    setcookie('lang', $lang, time() + 60 * 60 * 24 * 30, '/');

    return redirect(route('home'));
})->name('lang');

Route::get('/login', 'LoginController@index')->name('login');
Route::post('/login', 'LoginController@login')->name('login');

Route::get('/register', 'RegisterController@index')->name('register');

Route::get('/requests', 'RequestsController@index')->name('request');

Route::get('/newrequest', 'NewRequestController@index')->name('newrequest');

Route::get('/main', 'MainpageController@index')->name('main');

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

// Include authentication routes
Auth::routes();

// Dashboard group
Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'Dashboard\DashboardController@Home')->name('dashboard');

    // Bank accounts
    Route::get('/bankaccounts', 'Dashboard\BankaccountController@Read')->name('bankaccounts');
    Route::post('/bankaccounts', 'Dashboard\BankaccountController@Create');
    Route::get('/bankaccounts/delete/{account}', 'Dashboard\BankaccountController@Delete')->name('bankaccounts-delete');

    // Your account
    Route::get('/account', 'Dashboard\AccountController@Read')->name('account');
    Route::get('/account/delete', 'Dashboard\AccountController@Delete')->name('deleteaccount');

    // Requests
    Route::get('/requests', 'RequestController@List');

    // Logout
    Route::get('/logout', 'LoginController@Logout')->name('logout');
});
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

Route::get('lang/{locale}', 'LocalizationController@index')->name('lang');

//Route::get('/login', 'LoginController@index')->name('login');
//Route::post('/login', 'LoginController@login')->name('login');
//Route::get('/register', 'RegisterController@index')->name('register');

Route::get('/main', 'MainpageController@index')->name('main');

Route::post('/payment/webhook', 'RequestPaymentController@Webhook');

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
    Route::get('/requests', 'Dashboard\RequestController@List')->name('requests');
    Route::get('/request/{id}', 'Dashboard\RequestController@Read')->name('request');
    Route::get('/request/{id}/disable', 'Dashboard\RequestController@Disable')->name('disablerequest');
    Route::get('/request/{id}/share', 'Dashboard\RequestController@Share')->name('sharerequest');

    Route::get('/requests/create/', 'Dashboard\RequestController@Create')->name('createrequest');
    Route::post('/requests/create/', 'Dashboard\RequestController@CreatePost');

    Route::get('/pay/{id}', 'RequestPaymentController@index')->name('pay');
    Route::get('/pay/{id}/bank', 'RequestPaymentController@step2')->name('pay_choosebank');
    Route::get('/pay/{id}/finish', 'RequestPaymentController@Finished')->name('finished');
    Route::get('/pay/{id}/{bank}', 'RequestPaymentController@step3')->name('pay_createrequest');

    // Logout
    Route::get('/logout', 'LoginController@Logout')->name('logout');
});
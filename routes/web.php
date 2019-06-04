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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::middleware(['guest'])->group(function () {
    Route::get('/', 'HomeController@Home')->name('home');
});

Route::get('lang/{locale}', 'LocalizationController@index')->name('lang');

Route::post('/payment/webhook', 'RequestPaymentController@Webhook');

// Include authentication routes
Auth::routes();

// Dashboard group
Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'Dashboard\DashboardController@home')->name('dashboard');

    // Bank accounts
    Route::get('/bankaccounts', 'Dashboard\BankaccountController@read')->name('bankaccounts');
    Route::post('/bankaccounts', 'Dashboard\BankaccountController@create');
    Route::get('/bankaccounts/delete/{account}', 'Dashboard\BankaccountController@delete')->name('bankaccounts-delete');

    // Your account
    Route::get('/account', 'Dashboard\AccountController@read')->name('account');
    Route::get('/account/delete', 'Dashboard\AccountController@delete')->name('deleteaccount');

    // Requests
    Route::get('/requests', 'Dashboard\RequestController@list')->name('requests');
    Route::get('/request/{id}', 'Dashboard\RequestController@read')->name('request');
    Route::get('/request/{id}/disable', 'Dashboard\RequestController@disable')->name('disablerequest');
    Route::get('/request/{id}/share', 'Dashboard\RequestController@share')->name('sharerequest');

    Route::get('/requests/create/', 'Dashboard\RequestController@create')->name('createrequest');
    Route::post('/requests/create/', 'Dashboard\RequestController@createPost');

    Route::get('/pay/{id}/schedule', 'ScheduleController@index')->name('schedule');
    Route::post('/pay/{id}/schedule/', 'ScheduleController@indexPost')->name('schedule-calendar');
    Route::get('/pay/{id}/schedule/finish/{subscription_id}', 'ScheduleController@success')->name('schedule-success');

    Route::get('/pay/{id}', 'RequestPaymentController@index')->name('pay');
    Route::get('/pay/{id}/bank', 'RequestPaymentController@step2')->name('pay_choosebank');
    Route::get('/pay/{id}/finish', 'RequestPaymentController@finished')->name('finished');
    Route::get('/pay/{id}/{bank}', 'RequestPaymentController@step3')->name('pay_createrequest');

    // Logout
    Route::get('/logout', 'LoginController@logout')->name('logout');
});
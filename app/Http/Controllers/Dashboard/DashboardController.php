<?php

namespace App\Http\Controllers\Dashboard;

use App\BankAccount;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    function __construct()
    {
        $this->setLocale();
        $this->middleware('auth');
    }

    function Home()
    {
        $bankAccounts = BankAccount::all()->where('user_id', Auth::user()->id);

        return view('dashboard/index', ['bank_accounts' => $bankAccounts]);
    }
}

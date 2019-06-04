<?php

namespace App\Http\Controllers\Dashboard;

use App\BankAccount;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function home()
    {
        $bankAccounts = BankAccount::all()->where('user_id', Auth::user()->id);
        $requests = \App\Request::where('user_id', Auth::user()->id)->where('active', 1)->take(5)->get();

        return view('dashboard/index', ['bank_accounts' => $bankAccounts, 'requests' => $requests]);
    }
}

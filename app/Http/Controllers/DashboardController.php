<?php

namespace App\Http\Controllers;

use App\BankAccount;
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

    function Bankaccounts()
    {
        $bankAccounts = BankAccount::all()->where('user_id', Auth::user()->id);
        return view('dashboard/bankaccounts', ['bank_accounts' => $bankAccounts]);
    }

    function AddBankaccount(Request $request)
    {
        $account = new BankAccount();

        if (!isset($_POST['account'])) {
            $bankAccounts = BankAccount::all()->where('user_id', Auth::user()->id);
            return view('dashboard/bankaccounts', ['bank_accounts' => $bankAccounts])->withErrors(['account' => "Voer een IBAN bankrekening in"]);
        }

        $user_account_number = $_POST['account'];

        if (!preg_match('/([A-Z]{2})([0-9]{2})([A-Z]{4})([0-9]{8,10})/', $_POST['account'])) {
            $bankAccounts = BankAccount::all()->where('user_id', Auth::user()->id);
            return view('dashboard/bankaccounts', ['bank_accounts' => $bankAccounts])->withErrors(['account' => "Geen geldig IBAN formaat"]);
        }

        $account->iban = $_POST['account'];
        $account->user_id = Auth::user()->id;
        $account->save();

        return redirect('bankaccounts');
    }
}

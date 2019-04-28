<?php

namespace App\Http\Controllers\Dashboard;

use App\BankAccount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Bankaccounts extends Controller
{
    // List function
    public function Read(){
        $bankAccounts = BankAccount::all()->where('user_id', Auth::user()->id);
        return view('dashboard/bankaccounts', ['bank_accounts' => $bankAccounts]);
    }

    // Create function
    public function Create() {
        $account = new BankAccount();

        if (!isset($_POST['account'])) {
            return route('bankaccounts');
        }

        $user_accouknt_number = $_POST['account'];

        if (!preg_match('/([A-Z]{2})([0-9]{2})([A-Z]{4})([0-9]{8,10})/', $_POST['account'])) {
            return back()->withErrors(['account' => "Geen geldige IBAN rekening formaat"]);
        }

        $account->iban = $_POST['account'];
        $account->user_id = Auth::user()->id;
        $account->save();

        return redirect('bankaccounts');
    }

    // Delete function
    public function Delete($account) {
        $account = BankAccount::where([['iban', $account], ['user_id', Auth::user()->id]])->first();

        if (!isset($account))
            return back()->withErrors(['']);

        $account->delete();

        return redirect(route('bankaccounts'));
    }
}

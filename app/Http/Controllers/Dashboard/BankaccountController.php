<?php

namespace App\Http\Controllers\Dashboard;

use App\BankAccount;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BankaccountController extends Controller
{
    // List function
    public function read()
    {
        $bankAccounts = BankAccount::all()->where('user_id', Auth::user()->id);
        return view('dashboard/bankaccounts', ['bank_accounts' => $bankAccounts]);
    }

    // Create function
    public function create()
    {
        $account = new BankAccount();

        if (!isset($_POST['account'])) {
            return route('bankaccounts');
        }

        if (BankAccount::where("iban", $_POST['account'])->count() > 0) {
            return back()->withErrors(['account' => "Er is al een account wat deze rekening gebruikt."]);
        }

        if (!preg_match('/([A-Z]{2})([0-9]{2})([A-Z]{4})([0-9]{8,10})/', $_POST['account'])) {
            return back()->withErrors(['account' => "Geen geldige IBAN rekening formaat"]);
        }

        $account->iban = $_POST['account'];
        $account->user_id = Auth::user()->id;
        $account->save();

        return redirect('bankaccounts');
    }

    // Delete function
    public function delete($account)
    {
        $account = BankAccount::where([['iban', $account], ['user_id', Auth::user()->id]])->first();

        if ($account->canDelete()) {
            $account->delete();
        }

        return redirect(route('bankaccounts'));
    }
}

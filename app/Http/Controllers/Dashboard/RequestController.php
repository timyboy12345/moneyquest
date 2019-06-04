<?php

namespace App\Http\Controllers\Dashboard;

use App\BankAccount;
use App\Http\Controllers\Controller;
use App\Payment;
use App\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RequestController extends Controller
{
    public function list(Request $r)
    {
        return view('requests/list', ['requests' => \App\Request::all()]);
    }

    public function read($id, Request $r)
    {
        $request = \App\Request::find($id);

        if (!isset($request)) {
            return redirect(route('dashboard'));
        }

        $subscriptions = Subscription::where(['request_id' => $id, 'state' => 'active'])->get();
        $payments = Payment::where('request_id', $id)->get();
        return view('requests/index', ['request' => $request, 'payments' => $payments, 'subscriptions' => $subscriptions]);
    }

    public function create(Request $r)
    {
        $bankaccounts = BankAccount::where("user_id", Auth::user()->id)->get();

        return view('requests/create', ['bankaccounts' => $bankaccounts]);
    }

    public function createPost(Request $r)
    {
        $request_id = Str::random(50);

        $r->validate(
            [
                'quantity' => 'required|numeric|between:0,50000',
                'description' => 'required|min:3|max:160',
                'bankaccount' => 'required'
            ]
        );

        $request = new \App\Request(
            [
                "id" => $request_id,
                "user_id" => Auth::user()->id,
                "amount" => $r->input('quantity'),
                "description" => $r->input('description'),
                "bank_iban" => $r->input('bankaccount')
            ]
        );

        $request->save();

        return redirect(route('request', $request_id));
    }

    public function disable($id)
    {
        $request = \App\Request::find($id);

        if (!isset($request)) {
            return redirect(route('dashboard'));
        }

        $request->active = false;
        $request->save();

        return redirect(route('request', $id));
    }

    public function share($id)
    {
        $request = \App\Request::find($id);

        if (!$request->active) {
            return redirect(route('request', $request->id));
        }

        return view('requests/share', ['request' => $request]);
    }
}

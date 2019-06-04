<?php

namespace App\Http\Controllers\Dashboard;

use App\BankAccount;
use App\Http\Controllers\Controller;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;





class RequestController extends Controller
{
    public function List(Request $r)
    {
        return view('requests/list', ['requests' => \App\Request::all()]);
    }

    public function Read($id, Request $r)
    {
        $request = \App\Request::find($id);

        if (!isset($request)) return redirect(route('dashboard'));

        $payments = Payment::where('request_id', $id)->get();
        return view('requests/index', ['request' => $request, 'payments' => $payments]);
    }

    public function Create(Request $r)
    {
        $bankaccounts = BankAccount::where("user_id", Auth::user()->id)->get();

        return view('requests/create', ['bankaccounts' => $bankaccounts]);
    }

    public function CreatePost(Request $request)
    {
        $request_id = Str::random(50);

        $request->validate([
            'quantity' => 'required|numeric|between:0,50000',
            'description' => 'required|min:3|max:25',
            'bankaccount' => 'required'
        ]);

        $newrequest = new \App\Request([
            "id" => $request_id,
            "user_id" => Auth::user()->id,
            "amount" => $request->input('quantity'),
            "description" => $request->input('description'),
            "bank_iban" => $request->input('bankaccount'),
            "currency" => $request->input('currency'),
            "comment" => $request->input('comment'),
        ]);

        if($request->hasFile('image')){
            $newrequest->image = RequestController::SaveFeatured($request);
        }

        $newrequest->save();

        return redirect(route('request', $request_id));
    }

    public function Disable($id)
    {
        $request = \App\Request::find($id);

        if (!isset($request)) return redirect(route('dashboard'));

        $request->active = false;
        $request->save();

        return redirect(route('request', $id));
    }

    public function Share($id)
    {
        $request = \App\Request::find($id);

        if (!$request->active)
            return redirect(route('request', $request->id));

        return view('requests/share', ['request' => $request]);
    }

    private static function SaveFeatured(Request $request){
        return $request->file('image')->store('public');
    }
}

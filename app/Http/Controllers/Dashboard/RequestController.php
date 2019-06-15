<?php

namespace App\Http\Controllers\Dashboard;

use App\BankAccount;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MailController;
use App\Payment;
use App\Subscription;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
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

    public function sharePost($id)
    {
        $email = Input::get('email');
        $user = User::where('email', $email)->first();
        $request = \App\Request::find($id);
        $lang = Input::get('lang');

        if($lang == "en") {
            $view = 'emails.en.request';
        }
        else{
            $view = 'emails.request';
        }

        if($user != null) {
            Mail::send($view, ['user' => $user, 'request' => $request], function ($m) use ($user) {
                $m->from('hello@app.com', 'MoneyQuest');

                $m->to($user->email, $user->name)->subject('Nieuw betaalverzoek!');
            });
        }

        return view('requests/share', ['request' => $request]);
    }


    private static function SaveFeatured(Request $request){
        return $request->file('image')->store('public');
    }
}

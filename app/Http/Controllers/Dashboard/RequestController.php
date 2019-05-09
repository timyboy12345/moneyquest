<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RequestController extends Controller
{
    public function Read($id, Request $r)
    {
        $request = \App\Request::find($id);

        if (!isset($request)) return redirect(route('dashboard'));

        return view('requests/index', ['request' => $request]);
    }

    public function Create(Request $r)
    {
        return view('requests/new/index');
    }

    public function CreatePost(Request $r)
    {
        $request_id = Str::random(50);

        $request = new \App\Request([
            "id" => $request_id,
            "user_id" => Auth::user()->id,
            "amount" => $r->input('quantity')
        ]);

        $request->save();

        return redirect(route('request', $request_id));
    }
}

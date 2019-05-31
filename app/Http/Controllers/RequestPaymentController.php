<?php

namespace App\Http\Controllers;

use App\Request;

class RequestPaymentController extends Controller
{
    public function Index($id)
    {
        $request = Request::find($id);

        if (!isset($request))
            return redirect('home');

        return view('payrequest/index', ['request'=>$request]);
    }

    public function Step2()
    {
        return view('payrequest/step2/index');
    }

    public function Finished()
    {
        return view('payrequest/finished/index');
    }
}
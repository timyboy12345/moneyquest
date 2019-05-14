<?php

namespace App\Http\Controllers;

class RequestPaymentController extends Controller
{
    function __construct()
    {
        $this->setLocale();
    }

    public function Index(){
        return view('payrequest/index');
    }

    public function Step2(){
        return view('payrequest/step2/index');
    }

    public function Finished(){
        return view('payrequest/finished/index');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewRequestController extends Controller
{
    function __construct()
    {
        $this->setLocale();
        $this->middleware('guest');
    }

    public function Index() {
        return view('newrequest/index');
    }
}

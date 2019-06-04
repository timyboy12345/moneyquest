<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainpageController extends Controller
{
    public function __construct()
    {
        $this->setLocale();
        $this->middleware('guest');
    }

    public function index()
    {
        return view('usermainpage/index');
    }
}

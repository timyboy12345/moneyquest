<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function read()
    {
        return view('account/index');
    }

    public function delete()
    {
        $account = User::find(Auth::user()->id);

        $account->delete();

        return redirect('home');
    }
}

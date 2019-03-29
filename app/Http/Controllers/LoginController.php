<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    function __construct()
    {
        $this->setLocale();
        $this->middleware('guest', ['except' => 'Logout']);
    }

    public function Index()
    {
        return view('login/index');
    }

    public function Login()
    {
        $errors = array();

        if (!isset($_POST['email'])) {
            $errors['email'] = "Vul een geldig email adres in";
            return view('login/index')->with(compact('user'))->withErrors($errors);
        }

        if (sizeof($errors) == 0) {
            $user = User::all()->where("email", $_POST['email'])->first();

            if (!isset($user))
                return view('login/index')->with(compact('user'))->withErrors(['email' => "Email niet gevonden"]);

            if (!password_verify($_POST['password'], $user['password']))
                return view('login/index')->with(compact('user'))->withErrors(['password' => "Wachtwoord incorrect"]);

            Auth::login($user);
            return redirect('/home');
        }

        return view('login/index')->with(compact('user'))->withErrors($errors);
    }

    public function Logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

//        return $this->loggedOut($request) ?: redirect('/');
        return redirect('/');
    }

    protected function guard()
    {
        return Auth::guard();
    }
}

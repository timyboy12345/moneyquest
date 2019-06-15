<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\User;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function SendMail(Request $request, $id)
    {
        $user = User::findOrFail($id);

        Mail::send('emails.request', ['user' => $user], function ($m) use ($user) {
            $m->from('hello@app.com', 'MoneyQuest');

            $m->to($user->email, $user->name)->subject('Nieuw betaalverzoek!');
        });
    }
}

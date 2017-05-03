<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Token;

class LoginController extends Controller
{

    public function login(Token $token)
    {

        Auth::login($token->user);
        $token->delete();

        return redirect('/');

    }

}

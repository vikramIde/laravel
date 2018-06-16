<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Session;

class AuthController extends Controller
{
    //

    public function logout(){
		Auth::logout();
		Session::flush();
		return redirect('/login');
    }
}

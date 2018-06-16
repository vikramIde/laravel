<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ResponseHandler;
use Illuminate\Support\Facades\Input;
use File;
use Storage;
use Validator;
use App\User;

class UserController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Product Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling product.
    |
    */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function get_users(){
        $user_model = new User;
        $userList = $user_model::all();
        
        return json_encode($userList);
    }


}

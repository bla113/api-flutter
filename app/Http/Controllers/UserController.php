<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    static function users() {

        $user = User::all();


        return response()->json(['user'=>$user]);



    }
}

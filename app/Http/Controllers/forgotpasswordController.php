<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class forgotpasswordcodeController extends Controller
{
    public function forgotpassword(){
        return view('forgotpasswordpage');
    }
}
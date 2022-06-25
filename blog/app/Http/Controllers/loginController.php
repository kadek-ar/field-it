<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Sentinel;
use Validator;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;

class loginController extends Controller
{
    public function login(){
        return view('loginpage');
    }

    public function postLogin(Request $request){
        Sentinel::disableCheckpoints();
        $errorMsgs = [
            'email.required' => 'Please provide email id',
            'email.email' => 'The email must be a valid email',
            'password.required' => 'password is required'
        ];

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ], $errorMsgs);

        if($validator->fails()){
            $returnData = array(
                'status' => 'error',
                'message' => 'Please review fields',
                'errors' => $validator->errors()->all()
            );
            return response()->json($returnData, 500);
        }

        if(Sentinel::check()){
            return redirect('/');
        }else{
            $returnData = array(
                'status' => 'error',
                'message' => 'Please review',
                'errors' => ["Email or Password mismatched"]
            );
            return response()->json($returnData, 500);
        }

        
    }
    
   
}

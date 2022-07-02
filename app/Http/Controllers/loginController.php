<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Sentinel;
use Validator;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;


class loginController extends Controller
{
    public function authenticate(Request $request){
        
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            // dd(Auth::user());
            if(Auth::user()->status == 2){
                return redirect()->intended('/owner/field/view');
            }else if(Auth::user()->status == 3){
                return redirect()->intended('/admin/approval');
            }else{
                return redirect()->intended('/homepage');
            }
        }
        
        return back()->with('loginError', 'Your email or password is incorrect. Please try again.');

    }

    public function logout(Request $request){
        Auth::logout();
 
        request()->session()->invalidate();
    
        request()->session()->regenerateToken();
    
        return redirect('/');
    }

    // public function postLogin(Request $request){
    //     Sentinel::disableCheckpoints();
    //     $errorMsgs = [
    //         'email.required' => 'Please provide email id',
    //         'email.email' => 'The email must be a valid email',
    //         'password.required' => 'password is required'
    //     ];

    //     $validator = Validator::make($request->all(), [
    //         'email' => 'required|email',
    //         'password' => 'required'
    //     ], $errorMsgs);

    //     if($validator->fails()){
    //         $returnData = array(
    //             'status' => 'error',
    //             'message' => 'Please review fields',
    //             'errors' => $validator->errors()->all()
    //         );
    //         return response()->json($returnData, 500);
    //     }

    //     if(Sentinel::check()){
    //         return redirect('/');
    //     }else{
    //         $returnData = array(
    //             'status' => 'error',
    //             'message' => 'Please review',
    //             'errors' => ["Email or Password mismatched"]
    //         );
    //         return response()->json($returnData, 500);
    //     }

        
    // }
    
   
}

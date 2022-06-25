<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use Activation;
use App\Models\User;
use Mail;

class signupController extends Controller
{

    public function register(Request $request){

        $request->validate([
            'name' => 'required|max:255|min:4',
            'email' => "required|email",
            'password' => $request->password ? 'required|min:6|confirmed' : '',
            'password_confirmation' => $request->password ? 'required|min:6' : ''

        ]);

        $request->password = bcrypt($request->password);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'status' => 1,
        ]); 

        return redirect('/');

    }

    public function signup(){
        return view('signuppage')->with('data', $data);
    }

    public function registerUser(Request $request){
        $data = $request->all();

        $user = Sentinel::Register($request->all());

        $activate = Activation::create($user);
        $this->sendActivationEmail($user, $activate->code);
        return redirect('/');

    }

    public function sendActivationEmail($user, $code){
        Mail::send(
            'email.activation',
            ['user' => $user, 'code' => $code],
            function($message) use ($user){
                $message->to($user->email);
                $message->subject("$user->name", "Activate your account.");
            }
        );
    }

    
}

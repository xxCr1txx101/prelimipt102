<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Nexmo\Laravel\Facade\Nexmo;


class AuthController extends Controller
{
    public function registrationForm(){
        return view('register');
    }

    public function loginForm(){
        return view('login');
    }
    
    public function register(Request $request){
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
            'email' => 'required|email'
        ]);

        $token = Str::random(24);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'remember_token' => $token
        ]);

        Mail::send('verification-email', ['user'=>$user], function($mail) use ($user){
            $mail->to($user->email);
            $mail->subject('Account Verification');
            $mail->from('skrataa1223@gmail.com', 'IPT102 Prelim');
        });

        Nexmo::message()->send([
            'to' => '+639304279077',
            'from' => 'sender',
            'text' => 'Thank you for registering. Check your email for verification'
        ]);

        return redirect('/login')->with('Message', 'Your account has been created, Check your email for the verification.');
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'email|required',
            'password' => 'string|required',
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$user || $user->email_verified_at==null){
            return redirect('/login')->with('Error', 'Account not yet verified');
        }

        $login = auth()->attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);

        if(!$login) {
            return back()->with('Error', 'Invalid credentials');
        };

        return redirect('/dashboard');
    }

    public function verification(User $user, $token){
        if($user->remember_token!==$token) {
            return redirect('/login')->with('Error', 'The token is invalid.');
        }

        $user->email_verified_at = now();
        $user->save();

        return redirect('/login')->with('Message', 'Your account has been verified. You may now login.');
    }

    public function logout(Request $request){
        auth()->logout();
        return redirect('/login')->with('Message', 'Successfully logout');
    }
}

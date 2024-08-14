<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class forgetPasswordController extends Controller
{
    public function forgetPage()
    {
        return view('forgetPassword');
    }

    public function sendVerfication(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users'
        ]);
        
        $verfication = DB::table('password_reset_tokens')->where('email',$request->email)->first();
        if(!$verfication)
        {
            $code = str()->random(32);
            $date = Carbon::now();
            $insertVerfication = DB::table('password_reset_tokens')->insert([
                'email' => $request->email,
                'token' => $code,
                'created_at' => $date
            ]);

            if($insertVerfication)
            {
                Mail::send('verificationEmail', ['token' => $code] , function($message) use($request) {
                    $message->to($request->email);
                    $message->subject('Reset Password');
                });
                return redirect()->back()->with('success', 'Verfication email has been sent successfuly !');
            }
        }
        return redirect()->back()->with('error', 'We\'ve already sent verfication email before !');
    }

    public function repairPassword($token)
    {
        return view('repairPassword', ['token' => $token]);
    }

    public function changedPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed' ,
            'token' => 'required'
        ]);


        $email = DB::table('password_reset_tokens')->where('token', $request->token)->first();

        if(!$email)
        {
            return redirect()->back()->with('error', 'Wrong credentials !');
        }

        $hashedPass = Hash::make($request->password);
        $user = User::where('email', $email->email);
        $user->update([
            'password' => $hashedPass
        ]);

        DB::table('password_reset_tokens')->where('token', $request->token)->delete();
        
        return redirect()->route('loginPage')->with('success','Password Changed successfully!');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function registerPage(){
        if(auth()->check())
            return view('loggedIn');
        return view('register');
    }

    public function insertUser(Request $request)
    {
        $request->validate([
            "name" => "required|min:3|max:25|string",
            "email" => "required|email|unique:users",
            "userName" => "required|min:3|max:15|unique:users|string",
            "password" => "required|min:6|max:12|confirmed"
        ]);

        $insertion = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'userName' => $request->userName,
            'password' => Hash::make($request->password)
        ]);

        if(!$insertion)
            return redirect()->back()->with('error', 'Registration failed, try again');

        return redirect()->route('loginPage')->with('success', 'Registration was Successful , You can Login now !');
    }

    public function loginPage(){
        if(auth()->check())
            return redirect('loggedIn');
        return view('login');
    }

    public function userHomePage(Request $request)
    {
        $credentials = $request->validate([
            'userName' => 'required|exists:users|string',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials))
        {
            $request->session()->regenerate();
            return redirect()->route('loggedIn');
        }
        else
        {
            return redirect()->back()->with('error', 'Wrong credentials !');
        }
    }

    public function loggedIn()
    {
        if(!auth()->check())
            return redirect()->route('loginPage')->with('error', 'You have to login before using the User\'s home page !');
        return view('loggedIn');
    }

    public function logOut(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }


    public function checkEmail($email)
    {
        $user = User::where('email',$email)->first();

        if(!$user)
            return true;
        else
            return false;
    }

    public function checkUserName($userName)
    {
        $user = User::where('userName',$userName)->first();

        if(!$user)
            return true;
        else
            return false;
    }
}

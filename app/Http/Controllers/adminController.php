<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class adminController extends Controller
{
    public function adminPanel()
    {
        if(!auth()->check() || !Gate::allows('isAdmin'))
        {
            return redirect('/')->with('error', 'The admin panel is only for master Admins');
        }
        
        $users = User::orderBy('id', 'desc')->paginate(5);
        return view('adminPanel', compact('users'));
    }


    public function promoter($username)
    {
        if(!Gate::allows('isAdmin'))
        {
            return false;
        }

        $promotion = User::where('userName', $username)->update([
            'confirmed' => 1
        ]);
        if($promotion)
            return true;
    }


    public function deposer($username)
    {
        if(!Gate::allows('isAdmin'))
        {
            return false;
        }

        $depose = User::where('userName', $username)->update([
            'confirmed' => 0
        ]);
        if($depose)
            return true;
    }


    public function remover($username)
    {
        if(!Gate::allows('isAdmin'))
        {
            return false;
        }

        $deleteUser = User::where('userName', $username)->delete();
        if($deleteUser)
            return true;
    }
}

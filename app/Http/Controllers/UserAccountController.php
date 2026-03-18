<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use illuminate\Support\Facades\Hash;
use illuminate\Support\Facades\Auth;

class UserAccountController extends Controller
{
    
    public function create(){
        return inertia('UserAccount/Create');
    }

    public function store(Request $request){

        // $user = User::create($request->validate([
        //     'name' => 'required',
        //     'email' => 'required|email|unique:users',
        //     'password' => 'required|min:8|confirmed',
        // ]));

         $user = User::make($request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]));

        // $user->password = Hash::make($user->password);
        // $user->password = $user->password;
        $user->save();

        Auth::login($user);

        return redirect()->route('listing.index')->with('success', 'Account Created!');    
    }
}
 
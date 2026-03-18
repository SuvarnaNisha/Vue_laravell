<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\AuthController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth')->except(['index', 'show']);
    // }

    public function create()
    {
        return inertia('Auth/Login');
    }
 
    public function store(Request $request){
        // $request->validate([
        //     'email' => 'required| string | email',
        //     'password' => 'required | string',
        // ]);

        if(!Auth::attempt($request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]), true)){
            // throw ValidationException::withMessages([
            //     'email'=> 'Authentication Failed'
            // ]);

             return back()->withErrors([
                'email' => __('auth.failed'),
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended('/listing');
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('listing.index');
    }
    
}

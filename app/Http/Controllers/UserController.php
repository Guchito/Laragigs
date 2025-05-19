<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //Show register/create form
    public function create(){
        return view('users.register');
    }

    //Create new user
    public function store(Request $request){
        //validate the form
        $formFields = $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|min:6|confirmed',
        ]);
        //Hash password
        $formFields['password'] = bcrypt($formFields['password']);

        //Create user
        $user = User::create($formFields);

        //Login
        Auth::login($user);

        return redirect('/')->with('message', 'User created and logged in');
    }

    //Logout user
    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out');
    }

    //Show login form
    public function login(){
        return view('users.login');

    }

    //Login user
    public function authenticate(Request $request){
        //validate the form
        $formFields = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //Attempt to login
        if(Auth::attempt($formFields)){
            //regenerate session id
            $request->session()->regenerate();
            return redirect('/')->with('message', 'You are logged in');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
    }
}



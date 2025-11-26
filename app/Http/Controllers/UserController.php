<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // show register/create form 
    public function create(): \Illuminate\View\View
    {
        return view('users.register');
    }

    //create new user
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        // Validate the incoming request data
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6',
        ]);

        // Hash the password
        $formFields['password'] = bcrypt($formFields['password']);

        // Create the user
        $user = User::create($formFields);

        // Log the user in
        auth::login($user);

        // Redirect to home page with success message
        return redirect('/')->with('message', 'User created and logged in');
    }

    // logout user
    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out successfully.');
    }

    // show login form
    public function login() {
        return view('users.login');
    }


    //Authenticate user
    public function authenticate(Request $request){
     $formFields = $request->validate([
            'email' => ['required', 'email',],
            'password' => 'required'
        ]);

        if(Auth::attempt($formFields)){
            $request->session()->regenerate();

            return redirect('/')->with('message', 'You are now logged in');
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');


    }


}




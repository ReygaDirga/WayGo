<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('authentication.login');
    }

    public function authenticate(Request $request)
    {
    // Check username password logic        
        return redirect('/welcome'); 
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function CreateBlog()
    {
        return view('pages.profile_createBlog');
    }
}

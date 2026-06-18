<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        return view('blogs.blog');
    }

    public function BlogDetail()
    {
        return view('blogs.blog_detail');
    }
}

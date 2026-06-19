<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $recentPosts = Blog::latest()->take(6)->get(); 
        return view('blogs.blog', compact('recentPosts'));
    }

    public function BlogDetail()
    {
        return view('blogs.blog_detail');
    }

}

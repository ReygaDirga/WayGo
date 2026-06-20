<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    
    public function index()
    {
        $heroPosts = Blog::with(['pulau', 'user'])->inRandomOrder()->take(5)->get();
        $allPosts = Blog::with('pulau')->get()->shuffle();
        $recentPosts = Blog::latest()->take(6)->get(); 
        return view('blogs.blog', compact('recentPosts','allPosts','heroPosts'));
    }

    public function BlogDetail($id)
    {
        $detail = Blog::with(['pulau', 'user'])->findOrFail($id);
        return view('blogs.blog_detail', compact('detail'));
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Models\PulauBlog;
use App\Models\User;

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

    public function createBlog()
    {
        $user = auth()->user();
        $pulaus = PulauBlog::all(); 
        return view('profile.profile_createBlog', compact('user', 'pulaus'));
    }
    public function storeBlog(Request $request){
        $request->validate([
            'title'=> 'required|string|max:255',
            'location' => 'required|string|max:255',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'time_start' => 'nullable|string',
            'time_end' => 'nullable|string',
            'estimated_cost' => 'nullable|string',
            'tips' => 'nullable|string',
            'id_pulau' => 'required'
        ]);

        $imagePath = null;
        if($request->hasFile('image')){
            $imagePath = $request->file('image')->store('blogs','public');
        }
        $bestTime = null;
        if ($request->filled('time_start') && $request->filled('time_end')) {
            $bestTime = $request->time_start . ' - ' . $request->time_end;
        }

        // 4. Bersihin tulisan Cost (Misal: "IDR 900.000" jadi "900000")
        $cost = null;
        if ($request->filled('estimated_cost')) {
            // Hapus karakter selain angka
            $cost = preg_replace('/[^0-9]/', '', $request->estimated_cost);
        }

        // 5. Simpan ke Database MySQL (Tabel blogs)
        Blog::create([
            'user_id' => auth()->id(), // Otomatis masukin ID user yang lagi login
            'title' => $request->input('title'),
            'location' => $request->location,
            'image' => $imagePath,
            'content' => $request->input('content'),
            'best_time_visit' => $bestTime,
            'estimated_cost' => $cost,
            'tips' => $request->tips,
            'id_pulau' =>$request->id_pulau,
        ]);

        // Kalo udah sukses, balikin ke halaman profile
        return redirect()->route('profile')->with('success', 'Blog post successfully published!');
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\PulauBlog;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Budget;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user()->load('categories', 'budget');
        return view('profile.index', compact('user'));
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'title'    => 'required|max:255',
        //     'location' => 'required',
        //     'id_pulau' => 'required',
        //     'image'    => 'required|image|mimes:jpeg,png,jpg|max:2048',
        //     'content'  => 'required'
        // ]);
        
        $user = auth()->user();

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = asset('storage/' . $path);
        }

        $user->update([
            'name'        => $request->name,
            'phone'       => $request->phone,
            'dob'         => $request->dob,
            'location'    => $request->location,
            'description' => $request->description,
        ]);

        return redirect()->route('preferences');
    }   

    public function preferences()
    {
        $categories =Category::all();
        $budget = Budget::all();
        return view('authentication.preferences', compact('categories', 'budget'));
    }

    
    
    public function preferencesStore(Request $request)
    {
        $request->validate([
            'categories' => 'required|array|min:1|max:3',
            'budget_id' => 'required|exists:budgets,id',
            'location' => 'required|string',
        ]);

        $user = auth()->user();

        $user->update([
            'budget_id'   => $request->budget_id,
            'location' => $request->location,
        ]);

        $user->categories()->sync($request->categories);

        return redirect()->route('done');
    }

    public function editProfilePage()
    {
        $budgets = Budget::get();
        $categories = Category::get();

        return view('profile.profile_editProfile', compact('budgets', 'categories'));
    }

    public function editProfile(Request $request)
    {
        $user = auth()->user(); 
        $name = $request->input('name');
        $avatar = $request->input('avatar');
        $dob = $request->input('dob');
        $location = $request->input('location');
        $phone = $request->input('phone');
        $description = $request->input('description');
        $budget = $request->input('budget');
        $categories = $request->input('categories', []);

        $user->update([
            'name' => $name,
            'avatar' => $avatar,
            'phone' => $phone,
            'dob' => $dob,
            'description' => $description,
            'budget_id' => $budget,
            'location' => $location,
        ]);

        $user->categories()->sync($categories);

        return redirect()->route('profile')->with('success', 'Your profile has been updated successfully');

    }

    public function changePasswordPage()
    {
        return view('profile.profile_changePassword');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|min:8|confirmed',
        ]);

        $user = auth()->user();

        if (!\Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Old password is incorrect']);
        }

        $user->update([
            'password' => \Hash::make($request->password),
        ]);

        return redirect()->route('profile')->with('success', 'Your password has been changed successfully');
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
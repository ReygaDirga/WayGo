<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Budget;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user()->load('categories', 'budget');
        return view('profile.index', compact('user'));
    }

    public function store(Request $request)
    {
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

    public function createBlog()
    {

        return view('profile.profile_createBlog');
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

        return view('profile.profile_editProfile');
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
            return back()->withErrors(['current_password' => 'Password lama salah']);
        }

        $user->update([
            'password' => \Hash::make($request->password),
        ]);

        return redirect()->route('profile')->with('success', 'Password berhasil diubah');
    }
}
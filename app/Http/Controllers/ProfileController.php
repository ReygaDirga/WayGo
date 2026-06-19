<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

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
}
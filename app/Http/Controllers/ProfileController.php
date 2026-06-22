<?php

namespace App\Http\Controllers;


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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'dob' => 'required|date',
            'location' => 'nullable|string|max:255',
            'phone' => 'required|numeric',
            'description' => 'nullable|string|max:1000',
            'budget' => 'required|exists:budgets,id',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ]);

        $user = auth()->user();

        // Upload avatar jika ada
        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }

        $user->name = $validated['name'];
        $user->phone = $validated['phone'] ?? null;
        $user->dob = $validated['dob'] ?? null;
        $user->location = $validated['location'] ?? null;
        $user->description = $validated['description'] ?? null;
        $user->budget_id = $validated['budget'] ?? null;

        $user->save();

        $user->categories()->sync($validated['categories'] ?? []);

        return redirect()
            ->route('profile')
            ->with('success', 'Your profile has been updated successfully');

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
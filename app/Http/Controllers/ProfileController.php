<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
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
            'description' => $request->description,
        ]);

        return redirect()->route('preferences');
    }

    public function CreateBlog()
    {
        return view('pages.profile_createBlog');
    }

    public function preferencesStore(Request $request)
{
    $user = auth()->user();

    $user->update([
        'interests' => json_encode($request->interests),
        'budget'    => $request->budget,
        'location'  => $request->location,
    ]);

    return redirect()->route('done');
}
}


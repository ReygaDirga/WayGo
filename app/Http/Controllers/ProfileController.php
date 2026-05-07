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

        return redirect('/');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        // Dummy untuk test tampilan
        $user = (object) [
            'name'        => 'Ong Jason',
            'email'       => 'jason@example.com',
            'phone'       => '+62 812-3456-7890',
            'dob'         => '1998-01-01',
            'description' => 'Explorer · Traveler · Dreamer',
            'location'    => 'Semarang, Indonesia',
            'avatar'      => null,
            'budget'      => 'Medium',
            'interests'   => ['Nature', 'Culinary', 'Adventure', 'Culture'],
        ];

        return view('pages.profile', compact('user'));
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
            'description' => $request->description,
        ]);

        return redirect()->route('preferences');
    }

    public function createBlog()
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

    public function editProfilePage()
    {
        // Dummy untuk test
        $user = (object) [
            'name'        => 'Ong Jason',
            'email'       => 'jason@example.com',
            'phone'       => '+62 812-3456-7890',
            'dob'         => '1998-01-01',
            'description' => 'Explorer · Traveler · Dreamer',
            'location'    => 'Semarang, Indonesia',
            'avatar'      => null,
            'budget'      => 'Medium',
            'interests'   => ['Nature', 'Culinary', 'Adventure', 'Culture'],
        ];

        return view('pages.profile_editProfile', compact('user'));
    }

    public function editProfile(Request $request)
    {
        // $user = auth()->user();

        // if ($request->hasFile('avatar')) {
        //     $path = $request->file('avatar')->store('avatars', 'public');
        //     $user->avatar = asset('storage/' . $path);
        //     $user->save();
        // }

        // $user->update([
        //     'name'        => $request->name,
        //     'phone'       => $request->phone,
        //     'dob'         => $request->dob,
        //     'location'    => $request->location,
        //     'description' => $request->description,
        //     'interests'   => json_encode($request->interests),
        //     'budget'      => $request->budget,
        // ]);

        return redirect()->route('profile');
    }

    public function changePasswordPage()
    {
        return view('pages.profile_changePassword');
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
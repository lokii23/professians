<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.custom-profile');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([

            'first_name' => 'required',

            'middle_name' => 'required',

            'last_name' => 'required',

            'email' => 'required|email',

            'bio' => 'nullable|string|max:500',

            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

        ]);
        if ($request->hasFile('profile_photo')) {

            $image = $request->file('profile_photo');

            $imageName = time().'.'.$image->getClientOriginalExtension();

            $image->storeAs('profile_photos', $imageName, 'public');

            $user->profile_photo = $imageName;
        }
        $user->update([

            'first_name' => $request->first_name,

            'middle_name' => $request->middle_name,

            'last_name' => $request->last_name,

            'email' => $request->email,
            
            'profile_photo' => $user->profile_photo,

            'bio' => $request->bio,

        ]);

        return back()->with('success', 'Update successfully.');

    }

    public function changePassword(Request $request)
    {
        $request->validate([

            'current_password' => 'required',

            'new_password' => 'required|min:8',

        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {

            return back()->withErrors([
                'current_password' => 'Current password is incorrect.'
            ]);
        }

        $user->update([

            'password' => Hash::make($request->new_password)

        ]);

        return back()->with('success', 'Password updated successfully.');
    }
}
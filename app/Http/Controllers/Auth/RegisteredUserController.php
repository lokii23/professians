<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Carbon\Carbon;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([

            'first_name' => 'required|string|max:255',

            'middle_name' => 'required|string|max:255',

            'last_name' => 'required|string|max:255',

            'email' => 'required|email|unique:users,email',

            'contact_number' => 'required',

            'gender' => 'required',

            'birthday' => 'required|date',

            'course' => 'required',

            'password' => 'required|min:8|confirmed',

            'password_confirmation' => 'required',

        ], [

            'password.confirmed' => 'Password and Confirm Password do not match.',

        ]);


        $user = User::create([

            'first_name' => $request->first_name,

            'middle_name' => $request->middle_name,

            'last_name' => $request->last_name,

            'email' => $request->email,

            'password' => Hash::make($request->password),

            'contact_number' => $request->contact_number,

            'age' => Carbon::parse($request->birthday)->age,

            'gender' => $request->gender,

            'birthday' => $request->birthday,

            'role' => 'student',

            'course' => $request->course,

        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}

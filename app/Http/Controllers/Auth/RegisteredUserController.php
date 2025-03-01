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
use Illuminate\View\View;

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
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'max:255'],
            'postal_code' => ['required', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'province' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'profile_picture' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        // Mengambil file profile_picture
        if ($request->hasFile('profile_picture')) {
            $profilePicture = $request->file('profile_picture');
            // Generate nama file dengan timestamp
            $fileName = time() . '.' . $profilePicture->getClientOriginalExtension();
            // Simpan file ke public/profile_picture
            $profilePicture->move(custom_public_path('profile_picture'), $fileName);
        }
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'postal_code' => $request->postal_code, // Menyimpan postal_code
            'profile_picture' => $fileName, // Menyimpan nama file ke database
            'active' => 1,
            'role' => 'user',
            'province' => $request->province,
            'city' => $request->city,
            'address' => $request->address,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);
        
        return redirect()->intended('/');
    }
}

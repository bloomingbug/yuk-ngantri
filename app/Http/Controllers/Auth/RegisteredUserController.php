<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nim' => ['required', 'string', 'max:14', 'unique:App\Models\User,nim'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:App\Models\User,email'],
            'password' => ['required', 'confirmed', 'min:8', Rules\Password::defaults()],
        ]);

        $user = User::create([
            $nama_baru = ucwords(strtolower($request->name)),
            'name' => $nama_baru,
            'slug' => $request->nim,
            'nim' => $request->nim,
            'role' => 'mahasiswa',
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        return redirect('/login')->with('sukses', 'Pendaftaran Berhasil, Silahkan Login!');
    }
}

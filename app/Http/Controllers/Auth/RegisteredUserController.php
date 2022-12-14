<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use ParagonIE\CipherSweet\Exception\BlindIndexNotFoundException;

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
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'contact' => ['required', 'numeric', 'digits:11'],
            'birthday' => ['required', 'string', 'date', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'userId' => $this->generateUserID(),
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'contact' => $request->contact,
            'birthday' => $request->birthday,
            'two_factor_secret' => null,
            'is_2fa_enabled' => 0,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    public function userIDExists($id)
    {
        try {
            return User::whereBlind('userId', 'userId_index', $id)->first();
        } catch (BlindIndexNotFoundException $th) {
            return false;
        }
    }

    public function generateUserID()
    {
        $id = uniqid();
        if (User::firstWhere('userId', $id)) {
            $this->generateUserID();
        }
        return $id;
    }
}

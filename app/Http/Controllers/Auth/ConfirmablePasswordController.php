<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User as UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use ParagonIE\CipherSweet\Exception\BlindIndexNotFoundException;

class ConfirmablePasswordController extends Controller
{
    /**
     * Show the confirm password view.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        return view('auth.confirm-password');
    }

    /**
     * Confirm the user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function store(Request $request)
    {
        try {
            $userInfo = UserModel::whereBlind('email', 'email_index', (string) $request->user()->email)->first();
            $user = DB::table('users')->where('id', '=', $userInfo->id)->first();

            if (! Auth::guard('web')->validate([
                'id' => $user->id,
                //'email' =>$user->email ,#$request->user()->email,
                'password' => $request->password,
            ])) {
                throw ValidationException::withMessages([
                    'password' => __('auth.password'),
                ]);
            }

            $request->session()->put('auth.password_confirmed_at', time());

            return redirect()->intended();
        } catch (BlindIndexNotFoundException $th) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }
    }
}

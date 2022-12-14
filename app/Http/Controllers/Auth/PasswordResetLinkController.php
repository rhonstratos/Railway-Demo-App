<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User as UserModel;
use ErrorException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use ParagonIE\CipherSweet\Exception\BlindIndexNotFoundException;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        try {
            $userInfo = UserModel::whereBlind('email', 'email_index', (string) $request->email)->first();
            $user = DB::table('users')->where('id', '=', $userInfo->id)->first();
            //dd($request->only('email'));
            //dd($user->email);

            // We will send the password reset link to this user. Once we have attempted
            // to send the link, we will examine the response then see the message we
            // need to show to the user. Finally, we'll send out a proper response.
            $status = Password::sendResetLink(['email' => $user->email]);

            return $status == Password::RESET_LINK_SENT
                ? back()->with('status', __($status))
                : back()->withInput($request->only('email'))
                ->withErrors(['email' => __($status)]);
        } catch (BlindIndexNotFoundException $th) {
            return back()->withInput($request->only('email'))
                ->withErrors(['email' => __($status)]);
        } catch(ErrorException $e) {
            return back()->withInput($request->only('email'))
                ->withErrors(['email' => __(Password::INVALID_USER)]);
        }
    }
}

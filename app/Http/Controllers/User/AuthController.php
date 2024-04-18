<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordMail;
use App\Models\PasswordResetToken;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function index() {
        return view('user.login');
    }

    public function auth(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            return view('user.home', ['username' => $user->username]);
        }

        return redirect()->route('user.login')
        ->withInput($request->only('email'))
        ->withErrors(['credentials' => 'Invalid credentials']);
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function forgot_password() {
        return view('user.forgot-password');
    }

    public function forgot_password_act(Request $request)
     {

        $customMessage = [
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'email.exists' => 'Email tidak terdaftar di database',
        ];

        $request->validate([
            'email' =>'required|email|exists:users,email',
        ], $customMessage);

        $existingToken = PasswordResetToken::where('email', $request->email)->first();

        $token = Str::random(60);

        if($existingToken) {
            $existingToken->update([
                'token' => $token,
                'created_at' => now(),
            ]);
        }else {
            PasswordResetToken::create(
                [
                    'email' => $request->email,
                    'token' => $token,
                    'created_at' => now(),
                ]
            );
        }

        if ($request->email) {
            Mail::to($request->email)->send(new ResetPasswordMail($token));
        }

        return redirect()->route('forgot-password')->with('success', 'true');
    }

    public function validasi_forgot_password(Request $request, $token)
    {
        return view('user.mail-reset-password', compact('token'));
    }
}

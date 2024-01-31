<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class RegisterController extends Controller
{
    public function index() {
        return view('user.register');
    }

    public function store(Request $request) {
        $data = $request->except('_token');

        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

         //mengecek email di database
         $isEmailExist = User::where('email', $request->email)->exists();

         if($isEmailExist){
            return back()
            ->withErrors([
                'email' => 'This email already exists'
            ])
            ->withInput();
        }

        $data['password'] = Hash::make($request->password);

        $user = User::create($data);
        
         // Menetapkan peran "User" ke pengguna yang baru didaftarkan
        $user->assignRole('User');

        return redirect()->route('user.login');
    }
}

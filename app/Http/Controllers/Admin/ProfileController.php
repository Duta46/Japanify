<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function change_password() {
        return view('change-password');
    }

    public function update_password(Request $request) {
        $request->validate([
         'current_password' => 'required|string|max:100',
         'new_password'=> 'required|string|max:100',
         'new_password_confirmation' => 'required|same:new_password'
        ]);

        $user = Auth::user();

        if(Hash::check($request->current_password, $user->password)){
             $user->update([
                 'password'=>bcrypt($request->new_password)
             ]);

         return redirect()->back()->with('success', 'Password succesfully updated');
        }else{
         return redirect()->back()->with('error', 'Current password does not matched');
        }

     }
}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index() {
        return view('user.login');
    }

    public function register() {
        return view('user.register');
    }
}

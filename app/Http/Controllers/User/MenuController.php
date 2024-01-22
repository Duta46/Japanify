<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriTest;

class MenuController extends Controller
{
    public function index() {
        $menuTests = KategoriTest::All();
        return view('user.menu', compact('menuTests'));
    }
}

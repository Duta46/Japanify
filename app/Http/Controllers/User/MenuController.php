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

    public function show($menu_id) {
        $menuTest = KategoriTest::findOrFail($menu_id);
        return view('user.menu-detail',['menu_test' => $menu_id, 'menuTest' => $menuTest]);
    }
}

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

    // public function menudetail() {
    //     return view('user.menu-detail');
    // }

    public function show($menu_id) {
        $menuTest = KategoriTest::findOrFail($menu_id);
        return redirect()->route('user.ujian', ['menu_id' => $menu_id]);
    }
}

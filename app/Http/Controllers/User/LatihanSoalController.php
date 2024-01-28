<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Models\LatihanSoal;
use App\Models\KategoriTest;
use App\Models\Kategori;


class LatihanSoalController extends Controller
{
    public function index(Request $request)
    {
        $kategoris = Kategori::All();

        return view('user.latihan-soal.kategori', compact('kategoris'));
    }

}

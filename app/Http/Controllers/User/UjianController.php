<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\LatihanSoal;
use Illuminate\Http\Request;
use App\Models\SoalUjian;
use App\Models\PaketSoal;
use App\Models\Kategori;

class UjianController extends Controller
{
    public function index($kategori_test_id) {
        $packages = PaketSoal::where('kategori_test_id', $kategori_test_id)->get();
        $jumlahPaketSoal = PaketSoal::count();
        return view('user.ujian.package', compact('packages', 'jumlahPaketSoal'));
    }

    public function introduction($paketSoalId) {
        $paket = PaketSoal::find($paketSoalId);

        $soal = $paket->SoalUjian;

        $firstSoalId = SoalUjian::where('paket_soal_id', $paketSoalId)
        ->orderBy('kategori_id')
        ->orderBy('id')
        ->value('id');

        $kategoris = Kategori::withCount(['SoalUjian' => function ($query) use ($soal) {
            $query->whereIn('id', $soal->pluck('id'));
        }])->get();


        return view('user.ujian.introduction', ['paket' => $paket, 'kategoris' => $kategoris, 'firstSoalId' => $firstSoalId]);
    }
}

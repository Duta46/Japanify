<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LatihanSoal;
use Illuminate\Support\Facades\Session;
use App\Models\PaketSoalLatihanSoal;
use App\Models\KategoriTest;
use App\Models\Kategori;


class LatihanSoalController extends Controller
{
    public function index($kategori_test_id)
    {
        $paketSoals = PaketSoalLatihanSoal::where('kategori_test_id', $kategori_test_id)->get();
        $jumlahPaketSoal = PaketSoalLatihanSoal::where('kategori_test_id', $kategori_test_id)->count();
        return view('user.latihan-soal.package', compact('paketSoals', 'jumlahPaketSoal'));
    }

    private function fisherYatesShuffle($array)
    {
        $count = count($array);
        for ($i = $count - 1; $i > 0; $i--) {
            $j = rand(0, $i);
            if ($i != $j) {
                list($array[$i], $array[$j]) = array($array[$j], $array[$i]);
            }
        }

        return $array;
    }

    public function detailPaketSoal($paketSoalId)
    {

        $paket = PaketSoalLatihanSoal::find($paketSoalId);

        $soal = $paket->LatihanSoal;

        // $firstSoalId = SoalUjian::where('paket_soal_id', $paketSoalId)
        //     ->orderBy('kategori_id')
        //     ->orderBy('id')
        //     ->value('id');

        $kategoris = Kategori::withCount(['LatihanSoal' => function ($query) use ($soal) {
            $query->whereIn('id', $soal->pluck('id'));
        }])->get();

        $soalIds = LatihanSoal::where('paket_soal_latihan_soal_id', $paketSoalId)
            ->orderBy('kategori_id')
            ->pluck('id')
            ->toArray();

        $jumlahSoal = $soal->count();

        $jumlahSoalDiambil = min($jumlahSoal, 10);

        // Ambil 10 soal secara acak
        $shuffleSoal = $soal->random($jumlahSoalDiambil);

        // Ambil array ID dari 10 soal yang diacak
        $shuffledSoalIds = $shuffleSoal->pluck('id')->toArray();

        // Lakukan Fisher-Yates Shuffle pada array ID soal
        $shuffledSoalIds = $this->fisherYatesShuffle($shuffledSoalIds);

        // Simpan urutan soal yang telah diacak ke dalam session
        session(['shuffledSoalIds' => $shuffledSoalIds]);

        return view('user.latihan-soal.introduction', ['paket' => $paket, 'kategoris' => $kategoris, 'soalIds' => $soalIds, 'shuffledSoalIds' => $shuffledSoalIds]);
    }


    public function mulaiTest(Request $request, $paketSoalId, $soalId)
    {
        $soals = LatihanSoal::with('kategori')
            ->where('paket_soal_latihan_soal_id', $paketSoalId)
            ->orderBy('kategori_id')
            ->get();

        $currentSoal = $soals->firstWhere('id', $soalId);
        if (!$currentSoal) {
            return redirect()->back()->with('error', 'Soal tidak ditemukan.');
        }

        $shuffleSoal = $soals->random(10);
        $shuffledSoalIds = $shuffleSoal->pluck('id')->toArray();

        // Cek apakah session untuk urutan soal sudah ada atau belum
        if (!Session::has('shuffledSoalIds')) {
            $shuffledSoalIds = $this->fisherYatesShuffle($shuffledSoalIds);

            Session::put('shuffledSoalIds', $shuffledSoalIds);
        } else {
            // Jika sudah ada, gunakan urutan soal yang telah disimpan di session
            $shuffledSoalIds = Session::get('shuffledSoalIds');
        }

        // Mendapatkan indeks soal yang sedang dikerjakan
        $currentSoalIndex = array_search($soalId, $shuffledSoalIds);

        // Mendapatkan soal sebelumnya dan berikutnya
        $previousSoal = null;
        $nextSoal = null;
        if ($currentSoalIndex !== false) {
            $previousSoalIndex = $currentSoalIndex - 1;
            $nextSoalIndex = $currentSoalIndex + 1;

            if (isset($shuffledSoalIds[$previousSoalIndex])) {
                $previousSoal = $soals->firstWhere('id', $shuffledSoalIds[$previousSoalIndex]);
            }

            if (isset($shuffledSoalIds[$nextSoalIndex])) {
                $nextSoal = $soals->firstWhere('id', $shuffledSoalIds[$nextSoalIndex]);
            }
        }

        // Tentukan apakah soal yang sedang dikerjakan adalah yang terakhir dalam urutan soal
        $lastSoal = $currentSoalIndex === (count($shuffledSoalIds) - 1);

        dd(session()->all());

        return view('user.latihan-soal.exercise', [
            'soals' => $soals,
            'jumlahSoals' => count($soals),
            'currentSoal' => $currentSoal,
            'previousSoal' => $previousSoal,
            'nextSoal' => $nextSoal,
            'currentSoalIndex' => $currentSoalIndex,
            'lastSoal' => $lastSoal,
            'shuffledSoalIds' => $shuffledSoalIds,
        ]);
    }

    public function result()
    {
        return view('user.latihan-soal.result');
    }

    public function showResultPage(Request $request, $id)
    {
        $currentSoal = LatihanSoal::with('kategori')->find($id);

        $correctAnswer = $currentSoal->correct_answer;
        $pointsForCurrentSoal = $currentSoal->point_soal;


        $userAnswerKey = $request->input('user_answer_key');

        $answerMapping = [
            'bordered-radio-1' => 'A',
            'bordered-radio-2' => 'B',
            'bordered-radio-3' => 'C',
            'bordered-radio-4' => 'D',
        ];

        // Get the user's answer based on the key from the mapping
        $userAnswer = $answerMapping[$userAnswerKey] ?? null;

        $points = 0;

        if ($userAnswer === $correctAnswer) {
            if ($userAnswer === $currentSoal->correct_answer) {
                $points = $pointsForCurrentSoal;
            }
        }

        $kategoriTest = KategoriTest::find($id);
        $minimumPoint = $kategoriTest->point_ujian;

        return view('user.ujian.result', [
            'currentSoal' => $currentSoal,
            'correctAnswer' => $correctAnswer,
            'userAnswer' => $userAnswer,
            'points' => $points,
            'minimumPoint' => $minimumPoint
        ]);
    }
}

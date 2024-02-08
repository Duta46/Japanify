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

        return view('user.latihan-soal.introduction', ['paket' => $paket, 'kategoris' => $kategoris, 'soalIds' => $soalIds]);
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

    public function mulaiTest(Request $request, $paketSoalId, $soalId)
    {
        // Ambil daftar soal berdasarkan paket soal ID
        $soals = LatihanSoal::with('kategori')
            ->where('paket_soal_latihan_soal_id', $paketSoalId)
            ->orderBy('kategori_id')
            ->orderBy('id')
            ->get();

        // Cek apakah soal dengan ID yang diberikan ada dalam daftar soal
        $currentSoal = $soals->firstWhere('id', $soalId);
        if (!$currentSoal) {
            return redirect()->back()->with('error', 'Soal tidak ditemukan.');
        }

        // Cek apakah session untuk urutan soal sudah ada atau belum
        if (!Session::has('shuffledSoalIds')) {
            // Jika belum ada, maka lakukan shuffle dan simpan ke session
            $shuffledSoalIds = $this->fisherYatesShuffle($soals->pluck('id')->toArray());
            Session::put('shuffledSoalIds', $shuffledSoalIds);
        } else {
            // Jika sudah ada, gunakan urutan soal yang telah disimpan di session
            $shuffledSoalIds = Session::get('shuffledSoalIds');
        }

        // Mengambil urutan soal yang sesuai dengan yang diacak
        $sortedSoals = collect([]);
        foreach ($shuffledSoalIds as $id) {
            $soal = $soals->firstWhere('id', $id);
            if ($soal) {
                $sortedSoals->push($soal);
            }
        }

        // Temukan indeks soal yang sedang ditampilkan dalam urutan soal yang diacak
        $currentSoalIndex = $sortedSoals->search(function ($soal) use ($currentSoal) {
            return $soal->id === $currentSoal->id;
        });


        // Temukan soal sebelumnya dan berikutnya berdasarkan urutan yang diacak
        $previousSoal = $currentSoalIndex > 0 ? $sortedSoals[$currentSoalIndex - 1] : null;
        $nextSoal = $currentSoalIndex < $sortedSoals->count() - 1 ? $sortedSoals[$currentSoalIndex + 1] : null;

        // Tentukan apakah soal yang sedang dikerjakan adalah yang terakhir dalam urutan soal
        $lastSoal = $currentSoalIndex === $sortedSoals->count();

        return view('user.latihan-soal.exercise', [
            'soals' => $sortedSoals,
            'jumlahSoals' => $sortedSoals->count(),
            'currentSoal' => $currentSoal,
            'previousSoal' => $previousSoal,
            'nextSoal' => $nextSoal,
            'currentSoalIndex' => $currentSoalIndex,
            'lastSoal' => $lastSoal,
        ]);
    }






    //     // Mengambil ID soal yang sudah muncul sebelumnya dari sesi
    // $soalSudahMuncul = Session::get('soal_sudah_muncul', []);

    // $soals = SoalUjian::with('kategori')
    //     ->where('paket_soal_id', $paketSoalId)
    //     ->orderBy('kategori_id')
    //     ->orderBy('id')
    //     ->get();

    // // Mengambil urutan ID soal dari daftar soal
    // $soalIds = $soals->pluck('id')->toArray();

    // // Mengacak urutan ID soal menggunakan Fisher-Yates Shuffle
    // $shuffledSoalIds = $this->fisherYatesShuffle($soalIds);

    // // Mengambil indeks dari $soalId di dalam array $soalIds
    // $currentIndex = array_search($soalId, $soalIds);

    // // Memastikan indeks ditemukan
    // if ($currentIndex === false) {
    //     return redirect()->back()->with('error', 'Soal tidak ditemukan dalam urutan soal.');
    // }

    // // Mengambil ID soal dari urutan yang sesuai
    // $currentSoalId = $shuffledSoalIds[$currentIndex];



    // // Tambahkan ID soal yang sudah muncul ke dalam sesi
    // $soalSudahMuncul[] = $currentSoalId;
    // Session::put('soal_sudah_muncul', $soalSudahMuncul);

    // // Mendapatkan detail soal yang sedang dikerjakan
    // $currentSoal = $soals->firstWhere('id', $currentSoalId);

    // // Menentukan soal sebelumnya dan soal berikutnya
    // $previousSoal = null;
    // $nextSoal = null;

    // if ($currentIndex > 0) {
    //     $previousSoal = $soals->firstWhere('id', $shuffledSoalIds[$currentIndex - 1]);
    // }

    // if ($currentIndex < count($soalIds) - 1) {
    //     $nextSoal = $soals->firstWhere('id', $shuffledSoalIds[$currentIndex + 1]);
    // }

    // // Menentukan apakah soal yang sedang dikerjakan adalah yang terakhir
    // $lastSoal = ($currentIndex === count($soalIds) - 1);

    // // Menghitung nomor soal saat ini
    // $currentSoalIndex = $currentIndex + 1;

    // return view('user.ujian.exercise', [
    //     'currentSoal' => $currentSoal,
    //     'previousSoal' => $previousSoal,
    //     'nextSoal' => $nextSoal,
    //     'lastSoal' => $lastSoal,
    //     'soalIds' => $shuffledSoalIds,
    //     'currentSoalIndex' => $currentSoalIndex,
    // ]);

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

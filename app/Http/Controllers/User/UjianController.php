<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\LatihanSoal;
use Illuminate\Http\Request;
use App\Models\SoalUjian;
use App\Models\PaketSoal;
use App\Models\KategoriTest;
use App\Models\Kategori;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

class UjianController extends Controller
{
    public function index($kategori_test_id)
    {
        $packages = PaketSoal::where('kategori_test_id', $kategori_test_id)->get();
        $jumlahPaketSoal = PaketSoal::where('kategori_test_id', $kategori_test_id)->count();
        return view('user.ujian.package', compact('packages', 'jumlahPaketSoal'));
    }

    // private function fisherYatesShuffle($array)
    // {
    //     $count = count($array);
    //     for ($i = $count - 1; $i > 0; $i--) {
    //         $j = random_int(0, $i);
    //         if ($i !== $j) {
    //             $temp = $array[$i];
    //             $array[$i] = $array[$j];
    //             $array[$j] = $temp;
    //         }
    //     }
    //     return $array;
    // }

    public function introduction($paketSoalId)
    {
        $paket = PaketSoal::find($paketSoalId);

        if (!$paket) {
            abort(404);
        }

        $soal = $paket->Soal;

        $firstSoalId = SoalUjian::where('paket_soal_id', $paketSoalId)
        ->orderBy('kategori_id')
        ->orderBy('id')
        ->value('id');

        $kategoris = Kategori::withCount(['SoalUjian' => function ($query) use ($soal) {
            $query->whereIn('id', $soal->pluck('id'));
        }])->get();

        return view('user.ujian.introduction', ['paket' => $paket, 'kategoris' => $kategoris, 'firstSoalId' => $firstSoalId]);
    }
    // private function fisherYatesShuffle($array)
    // {
    //     $count = count($array);
    //     for ($i = $count - 1; $i > 0; $i--) {
    //         $j = rand(0, $i);
    //         if ($i != $j) {
    //             list($array[$i], $array[$j]) = array($array[$j], $array[$i]);
    //         }
    //     }
    //     return $array;
    // }

    public function mulaiTest(Request $request, $paketSoalId, $soalId)
    {

        $soals = SoalUjian::with('kategori')
            ->where('paket_soal_id', $paketSoalId)
            ->orderBy('kategori_id')
            ->orderBy('id')
            ->get();

        $currentSoal = $soals->firstWhere('id', $soalId);

        $currentSoalIndex = $soals->search(function ($soal) use ($currentSoal) {
            return $soal->id === optional($currentSoal)->id;
        });

        $previousSoal = null;
        $nextSoal = null;

        if ($currentSoalIndex !== false) {
            $isFirstQuestion = $currentSoalIndex === 0;
            $isLastQuestion = $currentSoalIndex === $soals->count() - 1;


            if (!$isFirstQuestion) {
                $previousSoal = $soals->get($currentSoalIndex - 1);
            }

            if (!$isLastQuestion) {
                $previousSoal = $soals->get($currentSoalIndex - 1);
                $nextSoal = $soals->get($currentSoalIndex + 1);
            }
        }

        $currentCategory = $currentSoal->kategori_id;
        $lastSoalCategory = $soals->where('kategori_id', $currentCategory);
        $lastSoal = $lastSoalCategory->last() && $currentSoal->id === $lastSoalCategory->last()->id;

        return view('user.ujian.exercise', [
            'soals' => $soals,
            'jumlahSoals' => $soals->count(),
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
        return view('user.ujian.result');
    }

    public function showResultPage(Request $request, $id)
    {
        $currentSoal = SoalUjian::with('kategori')->find($id);

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

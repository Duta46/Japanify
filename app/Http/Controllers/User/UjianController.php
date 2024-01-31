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

class UjianController extends Controller
{
    public function index($kategori_test_id)
    {
        $packages = PaketSoal::where('kategori_test_id', $kategori_test_id)->get();
        $jumlahPaketSoal = PaketSoal::count();
        return view('user.ujian.package', compact('packages', 'jumlahPaketSoal'));
    }

    private function fisherYatesShuffle($array)
    {
        $count = count($array);
        for ($i = $count - 1; $i > 0; $i--) {
            $j = random_int(0, $i);
            if ($i !== $j) {
                $temp = $array[$i];
                $array[$i] = $array[$j];
                $array[$j] = $temp;
            }
        }
        return $array;
    }



    public function introduction($paketSoalId)
    {
        $paket = PaketSoal::find($paketSoalId);

        $soal = $paket->SoalUjian;

        $firstSoalId = SoalUjian::where('paket_soal_id', $paketSoalId)
            ->orderBy('kategori_id')
            ->orderBy('id')
            ->value('id');

        $kategoris = Kategori::withCount(['SoalUjian' => function ($query) use ($soal) {
            $query->whereIn('id', $soal->pluck('id'));
        }])->get();

     // Acak setiap kategori menggunakan Fisher-Yates shuffle
    // foreach ($kategoris as $kategori) {
    //     if ($kategori->SoalUjian->isNotEmpty()) {
    //         $shuffledSoals = $this->fisherYatesShuffle($kategori->SoalUjian->toArray());
    //         $kategori->SoalUjian = collect($shuffledSoals);
    //     }
    // }

    // $soals = collect();
    // foreach ($kategoris as $kategori) {
    //     $soals = $soals->merge($kategori->SoalUjian);
    // }

    $soalIds = $soal->pluck('id')->toArray();

        return view('user.ujian.introduction', ['paket' => $paket, 'kategoris' => $kategoris, 'firstSoalId' => $firstSoalId, 'soalIds' => $soalIds]);
    }


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

        $soalIds = $soals->pluck('id')->toArray();

        return view('user.ujian.exercise', [
            'soals' => $soals,
            'jumlahSoals' => $soals->count(),
            'currentSoal' => $currentSoal,
            'previousSoal' => $previousSoal,
            'nextSoal' => $nextSoal,
            'currentSoalIndex' => $currentSoalIndex,
            'lastSoal' => $lastSoal,
            'soalIds' => 'soalIds'
        ]);
    }


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
            'minimumPoint' => $minimumPoint,
        ]);
    }
}

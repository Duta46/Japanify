<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SoalUjian;
use App\Models\PaketSoal;
use App\Models\KategoriTest;
use App\Models\Kategori;
use Illuminate\Support\Facades\Session;

class UjianController extends Controller
{
    public function index($kategori_test_id)
    {
        $packages = PaketSoal::where('kategori_test_id', $kategori_test_id)->get();
        $jumlahPaketSoal = PaketSoal::where('kategori_test_id', $kategori_test_id)->count();
        return view('user.ujian.package', compact('packages', 'jumlahPaketSoal'));
    }

    private function fisherYatesShuffle($array)
    {
        $count = count($array);
        for ($i = $count - 1; $i > 0; $i--) {
            $j = mt_rand(0, $i);
            $temp = $array[$i];
            $array[$i] = $array[$j];
            $array[$j] = $temp;
        }
        return $array;
    }

    public function introduction($paketSoalId)
    {
        $paket = PaketSoal::find($paketSoalId);

        if (!$paket) {
            return redirect()->route('package')->with('error', 'Paket soal tidak ditemukan');
        }

        $soal = $paket->SoalUjian;

        // $soal = SoalUjian::where('paket_soal_id', $paketSoalId)->get();

        if ($soal->isEmpty()) {
            return redirect()->route('user.introduction')->with('error', 'Tidak ada soal dalam paket ini');
        }

        // Mengelompokkan soal berdasarkan kategori
        $soalByCategory = $soal->groupBy('kategori_id');

        // Mengacak urutan soal di setiap kategori
        $soalByCategory->transform(function ($category) {
            return $category->shuffle();
        });

        // Menyimpan urutan soal yang sudah diacak ke dalam sesi Laravel
        Session::put('soalByCategory', $soalByCategory);

        $firstSoalId = SoalUjian::where('paket_soal_id', $paketSoalId)
            ->orderBy('kategori_id')
            ->orderBy('id')
            ->value('id');

        $kategoris = Kategori::withCount(['SoalUjian' => function ($query) use ($soal) {
            $query->whereIn('id', $soal->pluck('id'));
        }])->get();

        return view('user.ujian.introduction', ['paket' => $paket, 'kategoris' => $kategoris, 'firstSoalId' => $firstSoalId, 'soal' => $soal,  'soalByCategory' => $soalByCategory,]);
    }

    public function mulaiTest(Request $request, $paketSoalId, $soalId)
    {

        $soals = SoalUjian::with('kategori')
            ->where('paket_soal_id', $paketSoalId)
            ->orderBy('kategori_id')
            ->orderBy('id')
            ->get();

        // Mengambil urutan soal yang sudah diacak dari sesi Laravel
        $soalByCategory = Session::get('soalByCategory');

        // Menggabungkan semua soal dari setiap kategori menjadi satu koleksi soal
        $soals = collect();
        foreach ($soalByCategory as $category) {
            $soals = $soals->concat($category);
        }

        // Mengambil soal yang sedang ditampilkan
        $currentSoal = $soals->firstWhere('id', $soalId);

        // Menemukan index soal yang sedang ditampilkan dalam koleksi soal
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

        // dd(session()->all());

        return view('user.ujian.exercise', [
            'soals' => $soals,
            'jumlahSoals' => $soals->count(),
            'currentSoal' => $currentSoal,
            'previousSoal' => $previousSoal,
            'nextSoal' => $nextSoal,
            'currentSoalIndex' => $currentSoalIndex,
            'lastSoal' => $lastSoal,
            'soalByCategory' => $soalByCategory
        ]);

    }

    public function result(Request $request)
    {
        return view('user.ujian.result');
    }

    public function showResultPage(Request $request, $id)
    {
        $currentSoal = SoalUjian::with('kategori')->find($id);

        $correctAnswer = $currentSoal->correct_answer;
        $pointsForCurrentSoal = $currentSoal->point_soal;

        // Retrieve the user's answer key from session storage
        $userAnswerKey = $request->input('user_answer_key'); // Update this based on your session storage key

        // Mapping array for session storage keys and their corresponding answers
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

        return view('user.ujian.result', [
            'currentSoal' => $currentSoal,
            'correctAnswer' => $correctAnswer,
            'userAnswer' => $userAnswer,
            'points' => $points,
        ]);
    }
}

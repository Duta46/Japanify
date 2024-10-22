<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LatihanSoal;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Kategori;
use App\Models\PaketSoalLatihanSoal;
use App\Models\KategoriTest;
use Yajra\DataTables\DataTables;

class LatihanSoalController extends Controller
{
    public function index(Request $request)
    {
        $latihanSoal = LatihanSoal::get();

        if ($request->ajax()) {
            return DataTables::of($latihanSoal)
                ->addIndexColumn()
                ->editColumn('question', function ($item) {
                    if ($item->question) {
                        return $item->question;
                    } else {
                        return '-';
                    }
                })

                ->editColumn('question_image', function ($item) {
                    if ($item->question_image) {
                        $imagePath = "storage/soal/{$item->question_image}";
                        $imageUrl = asset($imagePath);
                        return  '<img src="' . $imageUrl . '" width="50%" height="50%">';
                    } else {
                        return '-';
                    }
                })

                ->editColumn('question_audio', function ($item) {
                    if ($item->question_audio) {
                        $audioPath = "storage/soal/{$item->question_audio}";
                        $audioUrl = asset($audioPath);
                        return '<audio controls><source src="' . $audioUrl . '" type="audio/mpeg"></audio>';
                    } else {
                        return '-';
                    }
                })
                ->addColumn('actions', function ($item) {
                    return
                        '<div class="dropdown text-end">
                    <button type="button" class="btn btn-secondary btn-sm btn-active-light-primary rotate" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" data-bs-toggle="dropdown">
                        Actions
                        <span class="svg-icon svg-icon-3 rotate-180 ms-3 me-0">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor"></path>
                            </svg>
                        </span>
                    </button>
                    <div class="dropdown-menu menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-100px py-4" data-kt-menu="true">
                        <div class="menu-item px-3">
                            <a href="' . route('admin.latihan-soal.show', $item->id) . '" class="menu-link px-3">
                                Soal Detail
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="' . route('admin.latihan-soal.edit', $item->id) . '" class="menu-link px-3">
                                Edit Soal
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a class="menu-link px-3 delete-confirm" data-id="' . $item->id . '" role="button">Hapus</a>
                        </div>
                    </div>
                </div>';
                })
                ->editColumn('kategori', function ($item) {
                    return $item->Kategori->name ? $item->Kategori->name : "-";
                })
                ->editColumn('paket_soal_latihan_soal', function ($item) {
                    return $item->PaketSoalLatihanSoal->name ? $item->PaketSoalLatihanSoal->name : "-";
                })
                ->editColumn('kategori_test', function ($item) {
                    return $item->KategoriTest->name ?? "-";
                })
                ->rawColumns(['actions', 'question_image', 'question_audio', 'question'])
                ->make();
        }
        return view('admin.latihan-soal.index');
    }

    public function create()
    {
        // $paketSoal = PaketSoal::select(['id', 'name'])->get();
        $kategoriTests = KategoriTest::select(['id', 'name'])->get();
        $kategoris = Kategori::select(['id', 'name'])->get();
        $paketSoal = PaketSoalLatihanSoal::select(['id', 'name'])->get();
        // $readingLatihanSoals = ReadingContentLatihanSoal::select(['id', 'text_content'])->get();

        return view('admin.latihan-soal.create', [
            'kategoris' => $kategoris,
            // 'readingLatihanSoals' => $readingLatihanSoals,
            'kategoriTests' => $kategoriTests,
            'paketSoal' => $paketSoal,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');

        $validate = [
            'question_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'question_audio' => 'nullable|audio|mimes:mpeg,mpga,mp3,wav,aac|max:5120',
            'answer_a_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'answer_b_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'answer_c_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'answer_d_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'correct_answer' => 'required|string',
            'point_soal' => 'required|string',
            'paket_soal_latihan_soal_id' => 'required',
            'kategori_id' => 'required',
            'reading_latihan_soal_id' => 'nullable',
            'kategori_test_id' => 'nullable',
            'image_content' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];

        //question
        if ($request->has('question')) {
            $validate['question'] = 'string';
            $input = strip_tags($request->input('question'));
            $input = preg_replace('/&hellip;|&nbsp;/', '', $input);
            $input = preg_replace('/&rdquo;/', '"', $input);
            $validate['question'] = 'nullable|string';
            $data['question'] = $input;
        } else {
            $data['question'] = null;
        }

        //question image
        if ($request->hasFile('question_image')) {
            $imageQuestion = $request->file('question_image');
            $originalImageQuestion = Str::random(10) . $imageQuestion->getClientOriginalName();
            $imageQuestion->storeAs('public/soal', $originalImageQuestion);
            $data['question_image'] = $originalImageQuestion;
        } else {
            $data['question_image'] = null;
        }

        //question audio
        if ($request->hasFile('question_audio')) {
            $audioQuestion = $request->file('question_audio');
            $originalAudioQuestion = Str::random(10) . $audioQuestion->getClientOriginalName();
            $audioQuestion->storeAs('public/soal', $originalAudioQuestion);
            $data['question_audio'] = $originalAudioQuestion;
        } else {
            $data['question_audio'] = null;
        }

        //answer a
        if ($request->input('answer_a_type') === 'text') {
            $validate['answer_a'] = 'string';
            $data['answer_a'] = $request->input('answer_a');
            $data['answer_a_image'] = null;
        } elseif ($request->input('answer_a_type') === 'image') {
            $answerAImage = $request->file('answer_a_image');
            $originalAnswerAImage = Str::random(10) . $answerAImage->getClientOriginalName();
            $answerAImage->storeAs('public/jawaban_a', $originalAnswerAImage);
            $data['answer_a_image'] = $originalAnswerAImage;
            $data['answer_a'] = null;
        }

        //answer b
        if ($request->input('answer_b_type') === 'text') {
            $validate['answer_b'] = 'string';
            $data['answer_b'] = $request->input('answer_b');
            $data['answer_b_image'] = null;
        } else if ($request->input('answer_b_type') === 'image') {
            // $answerBImage = $request->input('answer_b_image');
            $answerBImage = $request->file('answer_b_image');
            $originalAnswerBImage = Str::random(10) . $answerBImage->getClientOriginalName();
            $answerBImage->storeAs('public/jawaban_b', $originalAnswerBImage);
            $data['answer_b_image'] = $originalAnswerBImage;
            $data['answer_b'] = null;
        }

        //answer c
        if ($request->input('answer_c_type') === 'text') {
            $validate['answer_c'] = 'string';
            $data['answer_c'] = $request->input('answer_c');
            $data['answer_c_image'] = null;
        } else if ($request->input('answer_c_type') === 'image') {
            // $answerCImage = $request->input('answer_c_image');
            $answerCImage = $request->file('answer_c_image');
            $originalAnswerCImage = Str::random(10) . $answerCImage->getClientOriginalName();
            $answerCImage->storeAs('public/jawaban_c', $originalAnswerCImage);
            $data['answer_c_image'] = $originalAnswerCImage;
            $data['answer_c'] = null;
        }

        //answer d
        if ($request->input('answer_d_type') === 'text') {
            $validate['answer_d'] = 'string';
            $data['answer_d'] = $request->input('answer_d');
            $data['answer_d_image'] = null;
        } else if ($request->input('answer_d_type') === 'image') {
            $answerDImage = $request->file('answer_d_image');
            $originalAnswerDImage = Str::random(10) . $answerDImage->getClientOriginalName();
            $answerDImage->storeAs('public/jawaban_d', $originalAnswerDImage);
            $data['answer_d_image'] = $originalAnswerDImage;
            $data['answer_d'] = null;
        }

        $data['correct_answer'] = $request->input('correct_answer');

        //text content
        if ($request->has('text_content')) {
            $validate['text_content'] = 'string';
            $input = strip_tags($request->input('text_content'));
            $input = preg_replace('/&hellip;|&nbsp;/', '', $input);
            $input = preg_replace('/&rdquo;/', '"', $input);
            $validate['text_content'] = 'nullable|string';
            $data['text_content'] = $input;
        } else {
            $data['text_content'] = null;
        }

        //image_content
        if ($request->hasFile('image_content')) {
            $imageQuestion = $request->file('image_content');
            $originalImageQuestion = Str::random(10) . $imageQuestion->getClientOriginalName();
            $imageQuestion->storeAs('public/reading-latihan-soal', $originalImageQuestion);
            $data['image_content'] = $originalImageQuestion;
        } else {
            $data['image_content'] = null;
        }

        $request->validate($validate);

        LatihanSoal::create($data);

        // Menghitung jumlah soal dalam paket yang sesuai
        $paketSoal = PaketSoalLatihanSoal::find($data['paket_soal_latihan_soal_id']);
        $jumlahSoal = LatihanSoal::where('paket_soal_latihan_soal_id', $data['paket_soal_latihan_soal_id'])->count();

        // Memperbarui nilai jumlah_soal dalam tabel PaketSoal
        $paketSoal->jumlah_soal = $jumlahSoal;
        $paketSoal->save();

        return redirect()->route('admin.latihan-soal')->with('success', 'Berhasil Tambah Soal');
    }

    public function show(Request $request, $id)
    {
        $latihanSoal = LatihanSoal::find($id);

        return view('admin.latihan-soal.show', compact('latihanSoal'));
    }

    public function edit($id)
    {
        $latihanSoal = LatihanSoal::find($id);

        $kategoriTests = KategoriTest::select(['id', 'name'])->get();

        $categorySoal = Kategori::select(['id', 'name'])->get();

        // $readingLatihanSoals = ReadingContentLatihanSoal::select(['id', 'text_content'])->get();

        $paketSoal = PaketSoalLatihanSoal::select(['id', 'name'])->get();

        return view('admin.latihan-soal.edit', [
            'kategoriTests' => $kategoriTests,
            'categorySoal' => $categorySoal,
            'latihanSoal' => $latihanSoal,
            // 'readingLatihanSoals' => $readingLatihanSoals,
            'paketSoal' => $paketSoal,
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->except('_token');

        $validate = [
            'question_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'question_audio' => 'nullable|audio|mimes:mpeg,mpga,mp3,wav,aac|max:5120',
            'answer_a_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'answer_b_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'answer_c_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'answer_d_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'correct_answer' => 'required|string',
            'point_soal' => 'required|string',
            'paket_soal_latihan_soal_id' => 'required',
            'kategori_id' => 'required',
            'reading_latihan_soal_id' => 'nullable',
            'image_content' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];

        $latihanSoal = LatihanSoal::find($id);

        if ($request->has('question')) {
            $validate['question'] = 'string';
            $input = strip_tags($request->input('question'));
            $input = preg_replace('/&hellip;|&nbsp;/', '', $input);
            $input = preg_replace('/&rdquo;/', '"', $input);
            $validate['question'] = 'nullable|string';
            $data['question'] = $input;
        }

        //question image
        if ($request->hasFile('question_image')) {
            $imageQuestion = $request->file('question_image');
            $originalImageQuestion = Str::random(10) . $imageQuestion->getClientOriginalName();
            $imageQuestion->storeAs('public/soal', $originalImageQuestion);
            $data['question_image'] = $originalImageQuestion;

            Storage::delete('public/soal/' . $latihanSoal->question_image);
        }

        if ($request->hasFile('question_audio')) {
            $audioQuestion = $request->file('question_audio');
            $originalAudioQuestion = Str::random(10) . $audioQuestion->getClientOriginalName();
            $audioQuestion->storeAs('public/soal', $originalAudioQuestion);
            $data['question_audio'] = $originalAudioQuestion;

            Storage::delete('public/soal/' . $latihanSoal->question_audio);
        }

        //answer a
        if ($request->input('answer_a_type') === 'text') {
            $validate['answer_a'] = 'string';
            $data['answer_a'] = $request->input('answer_a');
            $data['answer_a_image'] = null;
        } elseif ($request->input('answer_a_type') === 'image') {
            $answerAImage = $request->file('answer_a_image');
            $originalAnswerAImage = Str::random(10) . $answerAImage->getClientOriginalName();
            $answerAImage->storeAs('public/jawaban_a', $originalAnswerAImage);
            $data['answer_a_image'] = $originalAnswerAImage;

            Storage::delete('public/jawaban_a/' . $latihanSoal->answer_a_image);

            $data['answer_a'] = null;
        } else {
            $data['answer_a_image'] = $latihanSoal->answer_a_image;
            $data['answer_a'] = null;
        }

        //answer b
        if ($request->input('answer_b_type') === 'text') {
            $validate['answer_b'] = 'string';
            $data['answer_b'] = $request->input('answer_b');
            $data['answer_b_image'] = null;
        } else if ($request->input('answer_b_type') === 'image') {
            // $answerBImage = $request->input('answer_b_image');
            $answerBImage = $request->file('answer_b_image');
            $originalAnswerBImage = Str::random(10) . $answerBImage->getClientOriginalName();
            $answerBImage->storeAs('public/jawaban_b', $originalAnswerBImage);
            $data['answer_b_image'] = $originalAnswerBImage;

            Storage::delete('public/jawaban_b/' . $latihanSoal->answer_b_image);

            $data['answer_b'] = null;
        } else {
            $data['answer_b_image'] = $latihanSoal->answer_b_image;
            $data['answer_b'] = null;
        }

        //answer c
        if ($request->input('answer_c_type') === 'text') {
            $validate['answer_c'] = 'string';
            $data['answer_c'] = $request->input('answer_c');
            $data['answer_c_image'] = null;
        } else if ($request->input('answer_c_type') === 'image') {
            // $answerCImage = $request->input('answer_c_image');
            $answerCImage = $request->file('answer_c_image');
            $originalAnswerCImage = Str::random(10) . $answerCImage->getClientOriginalName();
            $answerCImage->storeAs('public/jawaban_c', $originalAnswerCImage);
            $data['answer_c_image'] = $originalAnswerCImage;

            Storage::delete('public/jawaban_c/' . $latihanSoal->answer_c_image);

            $data['answer_c'] = null;
        } else {
            $data['answer_c_image'] = $latihanSoal->answer_c_image;
            $data['answer_c'] = null;
        }

        //answer d
        if ($request->input('answer_d_type') === 'text') {
            $validate['answer_d'] = 'string';
            $data['answer_d'] = $request->input('answer_d');
            $data['answer_d_image'] = null;
        } else if ($request->input('answer_d_type') === 'image') {
            // $answerDImage = $request->input('answer_d_image');
            $answerDImage = $request->file('answer_d_image');
            $originalAnswerDImage = Str::random(10) . $answerDImage->getClientOriginalName();
            $answerDImage->storeAs('public/jawaban_d', $originalAnswerDImage);
            $data['answer_d_image'] = $originalAnswerDImage;

            Storage::delete('public/jawaban_d/' . $latihanSoal->answer_d_image);

            $data['answer_d'] = null;
        } else {
            $data['answer_d_image'] = $latihanSoal->answer_d_image;
            $data['answer_d'] = null;
        }

        //reading_teks_id
        // if ($request->input('reading_latihan_soal_id') === 'null') {
        //     $data['reading_latihan_soal_id'] = null;
        // } else {
        //     $data['reading_latihan_soal_id'] = $request->input('reading_latihan_soal_id');
        // }

        if ($request->has('text_content')) {
            $validate['question'] = 'string';
            $input = strip_tags($request->input('question'));
            $input = preg_replace('/&hellip;|&nbsp;/', '', $input);
            $input = preg_replace('/&rdquo;/', '"', $input);
            $validate['question'] = 'nullable|string';
            $data['question'] = $input;
        }

        if ($request->hasFile('image_content')) {
            $imageQuestion = $request->file('image_content');
            $originalImageQuestion = Str::random(10) . $imageQuestion->getClientOriginalName();
            $imageQuestion->storeAs('public/reading-latihan-soal', $originalImageQuestion);
            $data['image_content'] = $originalImageQuestion;

            Storage::delete('public/reading-latihan-soal/' . $latihanSoal->image_content);
        }

        $latihanSoal->update($data);

        return redirect()->route('admin.latihan-soal')->with('success', 'Berhasil Ubah Soal');
    }

    public function destroy($id)
    {
        try {
            $latihanSoal = LatihanSoal::find($id);

            if (!$latihanSoal) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Soal not found',
                ], 404);
            }

            Storage::delete('public/soal/' . $latihanSoal->question_image);
            Storage::delete('public/soal/' . $latihanSoal->question_audio);
            Storage::delete('public/jawaban_a/' . $latihanSoal->answer_a_image);
            Storage::delete('public/jawaban_b/' . $latihanSoal->answer_b_image);
            Storage::delete('public/jawaban_c/' . $latihanSoal->answer_c_image);
            Storage::delete('public/jawaban_d/' . $latihanSoal->answer_d_image);
            Storage::delete('public/reading-latihan-soal/' . $latihanSoal->image_content);

            //Menghapus soal
            $latihanSoal->delete();

            // Menghitung ulang jumlah soal dalam paket yang sesuai
            $paketSoalLatihanSoalId = $latihanSoal->paket_soal_latihan_soal_id;
            $paketSoalLatihanSoal = PaketSoalLatihanSoal::find($paketSoalLatihanSoalId);

            if ($paketSoalLatihanSoal) {
                $jumlahSoal = LatihanSoal::where('paket_soal_latihan_soal_id', $paketSoalLatihanSoalId)->count();
                $paketSoalLatihanSoal->jumlah_soal = $jumlahSoal;
                $paketSoalLatihanSoal->save();
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Soal deleted',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function deleteImage($id)
    {
        $latihanSoal =  LatihanSoal::find($id);
        //question image
        if ($latihanSoal && $latihanSoal->question_image) {
            Storage::delete('public/soal/' . $latihanSoal->question_image);

            $latihanSoal->update(['question_image' => null]);

            return redirect()->back()->with('success', 'Gambar soal berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Tidak ada gambar yang dapat dihapus.');
        }

        //image content reading
        if ($latihanSoal && $latihanSoal->image_content) {
            Storage::delete('public/reading-latihan-soal/' . $latihanSoal->image_content);

            $latihanSoal->update(['image_content' => null]);

            return redirect()->back()->with('success', 'Gambar reading content berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Tidak ada gambar yang dapat dihapus.');
        }

        // answer a image
        if ($latihanSoal && $latihanSoal->answer_a_image) {
            Storage::delete('public/jawaban_a/' . $latihanSoal->answer_a_image);

            $latihanSoal->update(['answer_a_image' => null]);

            return redirect()->back()->with('success', 'Gambar jawaban a berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Tidak ada gambar yang dapat dihapus.');
        }

        // answer b image
        if ($latihanSoal && $latihanSoal->answer_b_image) {
            Storage::delete('public/jawaban_b/' . $latihanSoal->answer_b_image);

            $latihanSoal->update(['answer_b_image' => null]);

            return redirect()->back()->with('success', 'Gambar jawaban b berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Tidak ada gambar yang dapat dihapus.');
        }

        // answer c image
        if ($latihanSoal && $latihanSoal->answer_c_image) {
            Storage::delete('public/jawaban_c/' . $latihanSoal->answer_c_image);

            $latihanSoal->update(['answer_c_image' => null]);

            return redirect()->back()->with('success', 'Gambar jawaban c berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Tidak ada gambar yang dapat dihapus.');
        }

        // answer d image
        if ($latihanSoal && $latihanSoal->answer_d_image) {
            Storage::delete('public/jawaban_d/' . $latihanSoal->answer_d_image);

            $latihanSoal->update(['answer_d_image' => null]);

            return redirect()->back()->with('success', 'Gambar jawaban d berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Tidak ada gambar yang dapat dihapus.');
        }
    }

    public function deleteAudio($id)
    {
        $latihanSoal = LatihanSoal::find($id);

        if ($latihanSoal && $latihanSoal->question_audio) {
            Storage::delete('public/soal/' . $latihanSoal->question_audio);

            $latihanSoal->update(['question_audio' => null]);

            return redirect()->back()->with('success', 'Audio soal berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Tidak ada audio yang dapat dihapus.');
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LatihanSoal;
use App\Models\KategoriTest;
use App\Models\PaketSoalLatihanSoal;
use Yajra\DataTables\DataTables;


class PaketSoalLatihanSoalController extends Controller
{
    public function index(Request $request)
    {
        $paketSoalLatihanSoal = PaketSoalLatihanSoal::get();

        if ($request->ajax()) {
            return DataTables::of($paketSoalLatihanSoal)
                ->addIndexColumn()
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
                            <a href="' . route('admin.paket-soal-latihan-soal.show', $item->id) . '" class="menu-link px-3">
                                Paket Soal Detail
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="' . route('admin.paket-soal-latihan-soal.edit', $item->id) . '" class="menu-link px-3">
                                Edit Data
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a class="menu-link px-3 delete-confirm" data-id="' . $item->id . '" role="button">Hapus</a>
                        </div>
                    </div>
                </div>';
                })
                ->editColumn('kategori_test', function ($item) {
                    return $item->KategoriTest->name ?? "-";
                })
                ->rawColumns(['actions'])
                ->make();
        }
        return view('admin.paket-soal-latihan-soal.index');
    }

    public function create()
    {
        $kategoriTests = KategoriTest::select(['id', 'name'])->get();
        return view('admin.paket-soal-latihan-soal.create', compact('kategoriTests'));
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');

        $request->validate([
            'name' => 'required|string',
            'kategori_test_id' => 'nullable',
        ]);

        PaketSoalLatihanSoal::create($data);

        return redirect()->route('admin.paket-soal-latihan-soal')->with('success', 'Berhasil Tambah Paket Soal');
    }

    public function show(Request $request, $id)
    {
        $paketSoalLatihanSoal = PaketSoalLatihanSoal::find($id);

        $latihanSoal = LatihanSoal::find($id);

        if ($request->ajax()) {
            $soal = LatihanSoal::where('paket_soal_latihan_soal_id', $id)->get();
            return DataTables::of($soal)
                ->addIndexColumn()
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
                        <a href="' . route('admin.ujian-soal.show', $item->id) . '" class="menu-link px-3">
                            Detail Soal
                        </a>
                    </div>
                </div>
                </div>';
                })
                //question
                ->editColumn('question', function ($item) {
                    if ($item->question) {
                        return html_entity_decode($item->question);
                    } else {
                        return '-';
                    }
                })

                //question image
                ->editColumn('question_image', function ($item) {
                    if ($item->question_image) {
                        $imagePath = "storage/soal/{$item->question_image}";
                        $imageUrl = asset($imagePath);
                        return  '<img src="' . $imageUrl . '" width="50%" height="50%">';
                    } else {
                        return '-';
                    }
                })
                // ->rawColumns(['question_image'])

                ->editColumn('question_audio', function ($item) {
                    if ($item->question_audio) {
                        $audioPath = "storage/soal/{$item->question_audio}";
                        $audioUrl = asset($audioPath);
                        return '<audio controls><source src="' . $audioUrl . '" type="audio/mpeg"></audio>';
                    } else {
                        return '-';
                    }
                })
                ->editColumn('category_soal', function ($item) {
                    return $item->Kategori->name ?? "error";
                })
                ->rawColumns(['question_audio', 'question_image', 'actions'])
                ->make();
        }
        return view('admin.paket-soal-latihan-soal.show', [
            'paketSoalLatihanSoal' => $paketSoalLatihanSoal,
            'latihanSoal' => $latihanSoal,
        ]);
    }

    public function edit($id)
    {
        $paketSoalLatihanSoal = PaketSoalLatihanSoal::find($id);
        $kategoriTests = KategoriTest::select(['id', 'name'])->get();

        return view('admin.paket-soal-latihan-soal.edit', ['paketSoalLatihanSoal' => $paketSoalLatihanSoal,  'kategoriTests' => $kategoriTests]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->except('_token');

        $request->validate([
            'name' => 'required|string',
             'kategori_test_id' => 'nullable',
        ]);

        $paketSoalLatihanSoal = PaketSoalLatihanSoal::find($id);

        $paketSoalLatihanSoal->update($data);

        return redirect()->route('admin.paket-soal-latihan-soal')->with('success', 'Berhasil Ubah Data paket soal');
    }

    public function destroy($id)
    {
        try {
            $paketSoalLatihanSoal = PaketSoalLatihanSoal::find($id);

            if (!$paketSoalLatihanSoal) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Paket Soal not found',
                ], 404);
            }

            // Menghapus semua soal yang terkait dengan paket soal
            $latihanSoals = LatihanSoal::where('paket_soal_latihan_soal_id', $id)->get();

            //Menghapus semua soal yang terkait
            foreach ($latihanSoals as $latihanSoal) {
                $latihanSoal->delete();
            }

            $paketSoalLatihanSoal->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Paket Soal deleted',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}

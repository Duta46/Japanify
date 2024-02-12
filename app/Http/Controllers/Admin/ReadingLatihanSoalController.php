<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaketSoalLatihanSoal;
use Illuminate\Http\Request;
use App\Models\ReadingContentLatihanSoal;
use Yajra\DataTables\DataTables;

class ReadingLatihanSoalController extends Controller
{
    public function index(Request $request)
    {
        $soalReadingLatihanSoal = ReadingContentLatihanSoal::get();

        if ($request->ajax()) {
            return DataTables::of($soalReadingLatihanSoal)
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
                            <a href="' . route('admin.reading-latihan-soal.show', $item->id) . '" class="menu-link px-3">
                                Reading Content Detail
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="' . route('admin.reading-latihan-soal.edit', $item->id) . '" class="menu-link px-3">
                                Edit Data
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a class="menu-link px-3 delete-confirm" data-id="' . $item->id . '" role="button">Hapus</a>
                        </div>
                    </div>
                </div>';
                })
                ->editColumn('paket_soal_latihan_soal', function ($item) {
                    return $item->PaketSoalLatihanSoal->name ?? "-";
                })
                ->rawColumns(['actions'])
                ->make();
        }
        return view('admin.reading-content-latihan-soal.index');
    }

    public function create()
    {
        $paketSoal = PaketSoalLatihanSoal::select(['id', 'name'])->get();

        return view('admin.reading-content-latihan-soal.create', compact('paketSoal'));
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');

        $request->validate([
            'text_content' => 'required|string',
            'paket_soal_latihan_soal_id' => 'required|string',
        ]);

        $data['text_content'] = strip_tags($data['text_content']);

        $data['text_content'] = preg_replace('/&hellip;|&nbsp;/', '', $data['text_content']);

        ReadingContentLatihanSoal::create($data);

        return redirect()->route('admin.reading-latihan-soal')->with('success', 'Berhasil Tambah Reading Content');
    }

    public function show($id)
    {
        $Reading = ReadingContentLatihanSoal::find($id);

        return view('admin.reading-content-ujian-soal.show', compact('Reading'));
    }

    public function edit($id)
    {
        $paketSoal = PaketSoalLatihanSoal::select(['id', 'name'])->get();

        $Reading = ReadingContentLatihanSoal::find($id);

        return view('admin.reading-content-latihan-soal.edit', compact('Reading', 'paketSoal'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->except('_token');

        $request->validate([
            'text_content' => 'required|string',
            'paket_soal_latihan_soal_id' => 'nullable',
        ]);

        $data['text_content'] = strip_tags($data['text_content']);

        $data['text_content'] = preg_replace('/&hellip;|&nbsp;/', '', $data['text_content']);

        $Reading = ReadingContentLatihanSoal::find($id);

        $Reading->update($data);

        return redirect()->route('admin.reading-latihan-soal')->with('success', 'Berhasil Ubah Reading Content');
    }

    public function destroy($id)
    {
        try {
            $Reading = ReadingContentLatihanSoal::find($id);

            if (!$Reading) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Reading Content not found',
                ], 404);
            }

            $Reading->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Reading Content deleted',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}

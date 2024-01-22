<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriTest;
use App\Models\SoalUjian;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

use App\Models\LatihanSoal;

class KategoriTestController extends Controller
{
    public function index(Request $request)
    {
        $KategoriTest = KategoriTest::all();

        if ($request->ajax()) {
            return DataTables::of($KategoriTest)
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
                            <a href="' . route('admin.kategori-test.edit', $item->id) . '" class="menu-link px-3">
                                Edit Data
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a class="menu-link px-3 delete-confirm" data-id="' . $item->id . '" role="button">Hapus</a>
                        </div>
                    </div>
                </div>';
                })
                ->rawColumns(['actions'])
                ->make();
        }
        return view('admin.kategori-test.index');
    }

    public function create()
    {
        return view('admin.kategori-test.create');
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');

        $request->validate([
            'name' => 'required|string',
        ]);

        KategoriTest::create($data);

        return redirect()->route('admin.kategori-test')->with('success', 'Berhasil Tambah Kategori Test');
    }

    public function edit($id)
    {
        $Kategori = KategoriTest::find($id);

        return view('admin.kategori-test.edit', ['Kategori' => $Kategori]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->except('_token');

        $request->validate([
            'name' => 'required|string',
        ]);

        $Kategori = KategoriTest::find($id);

        $Kategori->update($data);

        return redirect()->route('admin.kategori-test')->with('success', 'Berhasil Ubah Kategori Test');
    }

    public function destroy($id)
    {
        try {
            $KategoriTest = KategoriTest::find($id);

            if (!$KategoriTest) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Test Kategori not found',
                ], 404);
            }

            SoalUjian::where('kategori_test_id', $id)->delete();

            LatihanSoal::where('kategori_test_id', $id)->delete();

            $KategoriTest->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Test Kategori deleted',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}

@extends('layouts.app')
@section('title', 'Edit Kategori Test')
@section('page-title')
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
        <h1 class="page-heading d-flex text-dark fw-bold flex-column justify-content-center my-0">
            Edit Kategori Test
        </h1>
    </div>
@endsection
@push('styles')
    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endpush
@section('content')
    <div class="card card-docs flex-row-fluid mb-2">
        <div class="card-body fs-6 text-gray-700">
            <form action="{{ route('admin.kategori-test.update', $Kategori->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="card-body p-9">
                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="name" class="fs-6 fw-bold mt-2 mb-3">Kategori Test</label>
                        </div>
                        <div class="col-lg">
                            <input type="text" name="name" class="form-control" value="{{ $Kategori->name }}"
                                placeholder="Input nama kategori soal " />

                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="point_ujian" class="fs-6 fw-bold mt-2 mb-3">Point Ujian</label>
                        </div>
                        <div class="col-lg">
                            <input type="number" name="point_ujian" class="form-control" value="{{ $Kategori->point_ujian }}"
                                placeholder="Input nama kategori soal " />
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="point_kategori_1" class="fs-6 fw-bold mt-2 mb-3">Poin Kategori 1</label>
                        </div>
                        <div class="col-lg">
                            <input type="number" name="point_kategori_1" class="form-control" value="{{ $Kategori->point_kategori_1 }}"
                                placeholder="Input Point Kategori 1" />
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="point_kategori_2" class="fs-6 fw-bold mt-2 mb-3">Poin Kategori 2</label>
                        </div>
                        <div class="col-lg">
                            <input type="number" name="point_kategori_2" class="form-control" value="{{ $Kategori->point_kategori_2 }}"
                                placeholder="Input Point Kategori 2" />
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="point_kategori_3" class="fs-6 fw-bold mt-2 mb-3">Poin Kategori 3</label>
                        </div>
                        <div class="col-lg">
                            <input type="number" name="point_kategori_3" class="form-control" value="{{ $Kategori->point_kategori_3 }}"
                                placeholder="Input Point Kategori 3" />
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="point_kategori_4" class="fs-6 fw-bold mt-2 mb-3">Poin Kategori 4</label>
                        </div>
                        <div class="col-lg">
                            <input type="number" name="point_kategori_4" class="form-control" value="{{ $Kategori->point_kategori_4 }}"
                                placeholder="Input Point Kategori 4" />
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

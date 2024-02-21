@extends('layouts.app')

@section('title', 'Kategori Test Details')

@section('page-title')
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
        <h1 class="page-heading d-flex text-dark fw-bold flex-column justify-content-center my-0">
            Kategori Test {{ $kategoriTest->name }} Details
        </h1>
    </div>
@endsection

@section('content')
    <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
        <div class="card-header cursor-pointer">
            <div class="card-title m-0">
                <h3 class="fw-bold m-0">Kategori Test Detail</h3>
            </div>
            <a href="{{ route('admin.kategori-test.edit', $kategoriTest) }}" class="btn btn-primary align-self-center">
                Edit
            </a>
        </div>
        <div class="card-body p-9">
            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">Nama Kategori Test</label>
                <div class="col-lg-8">
                    <span class="fw-bold fs-6 text-gray-800">{{ $kategoriTest->name }}</span>
                </div>
            </div>
            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">Point KKM Ujian</label>
                <div class="col-lg-8">
                    <span class="fw-bold fs-6 text-gray-800">{{ $kategoriTest->point_ujian }}</span>
                </div>
            </div>
            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">Point Kategori 1</label>
                <div class="col-lg-8">
                    <span class="fw-bold fs-6 text-gray-800">{{ $kategoriTest->point_kategori_1 }}</span>
                </div>
            </div>
            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">Point Kategori 2</label>
                <div class="col-lg-8">
                    <span class="fw-bold fs-6 text-gray-800">{{ $kategoriTest->point_kategori_2 }}</span>
                </div>
            </div>
            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">Point Kategori 3</label>
                <div class="col-lg-8">
                    <span class="fw-bold fs-6 text-gray-800">{{ $kategoriTest->point_kategori_3 }}</span>
                </div>
            </div>
            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">Point Kategori 4</label>
                <div class="col-lg-8">
                    <span class="fw-bold fs-6 text-gray-800">{{ $kategoriTest->point_kategori_4 }}</span>
                </div>
            </div>
        </div>
    @endsection

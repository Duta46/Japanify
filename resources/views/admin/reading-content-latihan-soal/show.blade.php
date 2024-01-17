@extends('layouts.app')

@section('title', 'Reading Content Details')

@section('page-title')
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
        <h1 class="page-heading d-flex text-dark fw-bold flex-column justify-content-center my-0">
            Reading Content
        </h1>
    </div>
@endsection

@section('content')
    <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
        <div class="card-header cursor-pointer">
            <div class="card-title m-0">
                <h3 class="fw-bold m-0">Reading Content Details</h3>
            </div>
            <a href="{{ route('admin.reading-latihan-soal.edit', $Reading) }}" class="btn btn-primary align-self-center">
                Edit
            </a>
        </div>
        <div class="card-body p-9">
            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">Reading Content</label>
                <div class="col-lg-8">
                    <span class="fw-bold fs-6 text-gray-800">{!! nl2br(e($Reading->text_content)) !!}</span>
                </div>
            </div>
            {{-- <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">Paket Soal</label>
                <div class="col-lg-8">
                    <span class="fw-bold fs-6 text-gray-800">{{ $Reading->PaketSoal->name }}</span>
                </div>
            </div> --}}
        </div>
    @endsection

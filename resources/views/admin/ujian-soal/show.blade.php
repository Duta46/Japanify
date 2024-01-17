@extends('layouts.app')

@section('title', 'Soal Detail')

@section('page-title')
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
        <h1 class="page-heading d-flex text-dark fw-bold flex-column justify-content-center my-0">
            Soal Detail
        </h1>
    </div>
@endsection

@section('content')
    <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
        <div class="card-header cursor-pointer">
            <div class="card-title m-0">
                <h3 class="fw-bold m-0">Ujian Soal Details</h3>
            </div>
            <a href="{{ route('admin.ujian-soal.edit', $latihanSoal) }}" class="btn btn-primary align-self-center">
                Edit
            </a>
        </div>
        <div class="card-body p-9">
            @if ($soalUjian->ReadingUjian)
                <div class="row mb-7">
                    <label class="col-lg-4 fw-semibold text-muted">Reading Content</label>
                    <div class="col-lg-8">
                        <span class="fw-bold fs-6 text-gray-800">{!! nl2br(e($soalUjian->ReadingUjian->text_content)) !!}</span>
                    </div>
                </div>
            @endif
            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">Soal</label>
                <div class="col-lg-8">
                    @if ($soalUjian->question)
                    <span class="fw-bold fs-6 text-gray-800">{!! nl2br(e($soalUjian->question)) !!}</span>
                    @else
                    <p>-</p>
                    @endif

                </div>
            </div>
            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">Soal Gambar</label>
                <div class="col-lg-8">
                    @if ($soalUjian->question_image)
                        <img src="{{ asset('storage/soal/' .$soalUjian->question_image) }}" alt="image" width="100px" height="100px" />
                    @else
                        <p>-</p>
                    @endif
                </div>
            </div>
            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">Soal Audio</label>
                <div class="col-lg-8">
                    @if ($soalUjian->question_audio)
                        <audio controls>
                            <source src="{{ asset('storage/soal/' . $soalUjian->question_audio) }}" type="audio/mpeg">
                        </audio>
                    @else
                        <p>-</p>
                    @endif
                </div>
            </div>
            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">Jawaban A</label>
                <div class="col-lg-8">
                    @if ($soalUjian->answer_a)
                        <span class="fw-bold fs-6 text-gray-800">{{ $soalUjian->answer_a }}</span>
                    @elseif ($soalUjian->answer_a_image)
                        <img src="{{ asset('storage/jawaban_a/' . $soalUjian->answer_a_image) }}" width="20%" height="20%" >
                    @endif
                </div>
            </div>
            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">Jawaban B</label>
                <div class="col-lg-8">
                    @if ($soalUjian->answer_b)
                        <span class="fw-bold fs-6 text-gray-800">{{ $soalUjian->answer_b }}</span>
                    @elseif ($soalUjian->answer_b_image)
                        <img src="{{ asset('storage/jawaban_b/' . $soalUjian->answer_b_image) }}" width="100px" height="100px" >
                    @endif
                </div>
            </div>
            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">Jawaban C</label>
                <div class="col-lg-8">
                    @if ($soalUjian->answer_c)
                        <span class="fw-bold fs-6 text-gray-800">{{ $soalUjian->answer_c }}</span>
                    @elseif ($soalUjian->answer_c_image)
                        <img src="{{ asset('storage/jawaban_c/' . $soalUjian->answer_c_image) }}" width="100px" height="100px" >
                    @endif
                </div>
            </div>
            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">Jawaban D</label>
                <div class="col-lg-8">
                    @if ($soalUjian->answer_d)
                        <span class="fw-bold fs-6 text-gray-800">{{ $soalUjian->answer_d }}</span>
                    @elseif ($soalUjian->answer_d_image)
                        <img src="{{ asset('storage/jawaban_d/' . $soalUjian->answer_d_image) }}" width="100px" height="100px">
                    @endif
                </div>
            </div>
            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">Kunci Jawaban</label>
                <div class="col-lg-8">
                    <span class="fw-bold fs-6 text-gray-800">{{ $soalUjian->correct_answer }}</span>
                </div>
            </div>
            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">Point Soal</label>
                <div class="col-lg-8">
                    <span class="fw-bold fs-6 text-gray-800">{{ $soalUjian->point_soal }}</span>
                </div>
            </div>
            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">Kategori Soal</label>
                <div class="col-lg-8">
                    <span class="fw-bold fs-6 text-gray-800">{{ $soalUjian->Kategori->name }}</span>
                </div>
            </div>
            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">Paket Soal</label>
                <div class="col-lg-8">
                    <span class="fw-bold fs-6 text-gray-800">{{ $soalUjian->PaketSoal->name }}</span>
                </div>
            </div>
        </div>
    @endsection

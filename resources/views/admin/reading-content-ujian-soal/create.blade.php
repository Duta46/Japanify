@extends('layouts.app')
@section('title', 'Tambah Reading Content')
@section('page-title')
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
        <h1 class="page-heading d-flex text-dark fw-bold flex-column justify-content-center my-0">
            Tambah Reading Content
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
            <form action="{{ route('admin.reading-ujian.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body p-9">
                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="text_content" class="fs-6 fw-bold mt-2 mb-3">Reading Content</label>
                        </div>
                        <div class="col-lg">
                            <textarea name="text_content" id="text_content" class="form-control" placeholder="Input Reading Content">{!!  old('text_content') !!}</textarea>
                            @error('text_content')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="paket_soal_id" class="fs-6 fw-bold mt-2 mb-3">Paket Soal</label>
                        </div>
                        <div class="col-lg">
                            <select name="paket_soal_id" id="paket_soal_id" class="form-select custom-placeholder" data-control="select2" data-placeholder="Pilih Paket Soal">
                                <option value="" disabled selected>Pilih Paket Soal</option>
                                @foreach($paketSoal as $paket)
                                    <option value="{{ $paket->id }}">{{ $paket->name }}</option>
                                @endforeach
                            </select>
                            @error('paket_soal_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <a href="{{ route('admin.reading-ujian') }}" type="reset"
                        class="btn btn-light btn-active-light-primary me-2">Batalkan</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
{{-- <script src="/js/tinymce/tinymce.min.js"></script> --}}
<script>
   function initTinyMCE(selector) {
        tinymce.init({
            selector: selector,
            forced_root_block: 'p',
            force_br_newlines: true,
        });
    }
    initTinyMCE('textarea#text_content');
</script>

<script>
    const inputs = document.querySelectorAll('.custom-placeholder');

inputs.forEach(function (input) {
    const originalPlaceholder = input.getAttribute('data-placeholder');

    input.addEventListener('focus', function () {
        this.setAttribute('placeholder', originalPlaceholder);
    });

    input.addEventListener('blur', function () {
        this.removeAttribute('placeholder');
    });
});
</script>

@endpush

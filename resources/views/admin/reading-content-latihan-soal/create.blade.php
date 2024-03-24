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
            <form action="{{ route('admin.reading-latihan-soal.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body p-9">
                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="text_content" class="fs-6 fw-bold mt-2 mb-3">Reading Content</label>
                        </div>
                        <div class="col-lg">
                            <textarea name="text_content" id="text_content" class="form-control" placeholder="Input Reading Content">{!!  old('text_content') !!}</textarea>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="image_content" class="fs-6 fw-bold mt-2 mb-3">Image Content</label>
                        </div>
                        <div class="col-lg">
                            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 h-15" id="file_input" name="image_content" type="file">
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPG or JPEG(MAX. 5MB).</p>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="paket_soal_latihan_soal_id" class="fs-6 fw-bold mt-2 mb-3">Paket Soal</label>
                        </div>
                        <div class="col-lg">
                            <select name="paket_soal_latihan_soal_id" id="paket_soal_latihan_soal_id" class="form-select custom-placeholder" data-control="select2" data-placeholder="Pilih Paket Soal">
                                <option value="" disabled selected>Pilih Paket Soal</option>
                                @foreach($paketSoal as $paket)
                                    <option value="{{ $paket->id }}">{{ $paket->name }}</option>
                                @endforeach
                            </select>
                            @error('paket_soal_latihan_soal_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <a href="{{ route('admin.reading-latihan-soal') }}" type="reset"
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

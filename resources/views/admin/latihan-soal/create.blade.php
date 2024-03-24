@extends('layouts.app')
@section('title','Tambah Soal')
@section('page-title')
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
        <h1 class="page-heading d-flex text-dark fw-bold flex-column justify-content-center my-0">
            Tambah Soal
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
            <form action="{{ route('admin.latihan-soal.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body p-9">
                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="question" class="fs-6 fw-bold mt-2 mb-3">Soal</label>
                        </div>
                        <div class="col-lg">
                            <textarea name="question" id="question" class="form-control" placeholder="Input Soal">{!!  old('question') !!}</textarea>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="question_image" class="fs-6 fw-bold mt-2 mb-3">Soal Gambar</label>
                        </div>
                        <div class="col-lg">
                            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 h-15" id="file_input" name="question_image" type="file">
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPG or JPEG(MAX. 5MB).</p>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="question_audio" class="fs-6 fw-bold mt-2 mb-3">Soal Audio</label>
                        </div>
                        <div class="col-lg">
                            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 h-15" id="file_input" name="question_audio" type="file">
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">MP3(MAX. 5MB).</p>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="text_content" class="fs-6 fw-bold mt-2 mb-3">Konten Bacaan</label>
                        </div>
                        <div class="col-lg">
                            <textarea name="text_content" id="text_content" class="form-control" placeholder="Input Reading Content">{!!  old('text_content') !!}</textarea>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="image_content" class="fs-6 fw-bold mt-2 mb-3">Konten Bacaan Gambar</label>
                        </div>
                        <div class="col-lg">
                            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 h-15" id="file_input" name="image_content" type="file">
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPG or JPEG(MAX. 5MB).</p>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="answer_a" class="fs-6 fw-bold mt-2 mb-3">Jawaban A</label>
                        </div>
                        <div class="col-lg">
                            <input type="radio" name="answer_a_type" value="text" id="textAnswerRadio" checked />
                            <label for="textAnswerRadio">Teks</label>
                            <input type="radio" name="answer_a_type" value="image" id="imageAnswerRadio" />
                            <label for="imageAnswerRadio">Gambar</label>
                            <textarea name="answer_a" id="answer_a" class="form-control z-depth-1 mt-2"  rows="3" placeholder="Input Jawaban A">{{ old('answer_a') }}</textarea>
                            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 h-15 mt-2" name="answer_a_image" id="imageAnswerA" type="file" style="display: none;" />
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_image_answer_a" style="display: none;">PNG, JPG or JPEG(MAX. 5MB).</p>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="answer_b" class="fs-6 fw-bold mt-2 mb-3">Jawaban B</label>
                        </div>
                        <div class="col-lg">
                            <input type="radio" name="answer_b_type" value="text" id="textAnswerRadioB" checked />
                            <label for="textAnswerRadioB">Teks</label>
                            <input type="radio" name="answer_b_type" value="image" id="imageAnswerRadioB" />
                            <label for="imageAnswerRadioB">Gambar</label>
                            <textarea name="answer_b" id="answer_b" class="form-control z-depth-1 mt-2" rows="3" placeholder="Input Jawaban B">{{  old('answer_b') }}</textarea>
                            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 h-15 mt-2" name="answer_b_image" id="imageAnswerB" type="file" style="display: none;" />
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_image_answer_b" style="display: none;">PNG, JPG or JPEG(MAX. 5MB).</p>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="answer_c" class="fs-6 fw-bold mt-2 mb-3">Jawaban C</label>
                        </div>
                        <div class="col-lg">
                            <input type="radio" name="answer_c_type" value="text" id="textAnswerRadioC" checked />
                            <label for="textAnswerRadioC">Teks</label>
                            <input type="radio" name="answer_c_type" value="image" id="imageAnswerRadioC" />
                            <label for="imageAnswerRadioC">Gambar</label>
                            <textarea name="answer_c" id="answer_c" class="form-control z-depth-1 mt-2" rows="3" placeholder="Input Jawaban C">{{  old('answer_c') }}</textarea>
                            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 h-15 mt-2" name="answer_c_image" id="imageAnswerC" type="file" style="display: none;" />
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_image_answer_c" style="display: none;">PNG, JPG or JPEG(MAX. 5MB).</p>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="answer_d" class="fs-6 fw-bold mt-2 mb-3">Jawaban D</label>
                        </div>
                        <div class="col-lg">
                            <input type="radio" name="answer_d_type" value="text" id="textAnswerRadioD" checked />
                            <label for="textAnswerRadioD">Teks</label>
                            <input type="radio" name="answer_d_type" value="image" id="imageAnswerRadioD" />
                            <label for="imageAnswerRadioD">Gambar</label>
                            <textarea name="answer_d" id="answer_d" class="form-control z-depth-1 mt-2" rows="3" placeholder="Input Jawaban D">{{  old('answer_d') }}</textarea>
                            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 h-15 mt-2" name="answer_d_image" id="imageAnswerD" type="file" style="display: none;" />
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_image_answer_d" style="display: none;">PNG, JPG or JPEG(MAX. 5MB).</p>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="correct_answer" class="fs-6 fw-bold mt-2 mb-3">Kunci Jawaban</label>
                        </div>
                        <div class="col-lg">
                            <select name="correct_answer" class="form-select custom-placeholder @error('correct_answer') is-invalid @enderror" data-control="select2" data-placeholder="Pilih Kunci Jawaban">
                                <option value="" disabled selected>Pilih Kunci Jawaban</option>
                                <option {{ old('correct_answer') == 'A' ? "selected" : "" }} value="A">A</option>
                                <option {{ old('correct_answer') == 'B' ? "selected" : "" }} value="B">B</option>
                                <option {{ old('correct_answer') == 'C' ? "selected" : "" }} value="C">C</option>
                                <option {{ old('correct_answer') == 'D' ? "selected" : "" }} value="D">D</option>
                            </select>
                            @error('correct_answer')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="point_soal" class="fs-6 fw-bold mt-2 mb-3">Point Soal</label>
                        </div>
                        <div class="col-lg">
                            <input type="number" name="point_soal" class="form-control" placeholder="Input Point Soal" />{{ old('point_soal') }}
                            @error('answer_d')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="kategori_id" class="fs-6 fw-bold mt-2 mb-3">Kategori Soal</label>
                        </div>
                        <div class="col-lg">
                            <select name="kategori_id" id="kategori_id" class="form-select custom-placeholder" data-control="select2" data-placeholder="Pilih Kategori Soal">
                                <option value="" disabled selected> Pilih Kategori Soal</option>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                                @endforeach
                            </select>
                            @error('kategori_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
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

                    {{-- <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="reading_latihan_soal_id" class="fs-6 fw-bold mt-2 mb-3">Content Reading</label>
                        </div>
                        <div class="col-lg">
                            <select name="reading_latihan_soal_id" id="reading_latihan_soal_id" class="form-select custom-placeholder" data-control="select2" data-placeholder="Pilih Content Reading">
                                <option value="" disabled selected>Pilih Content Reading</option>
                                @foreach($readingLatihanSoals as $readingLatihanSoal)
                                    <option value="{{ $readingLatihanSoal->id }}">{{ $readingLatihanSoal->text_content }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}
                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="kategori_test_id" class="fs-6 fw-bold mt-2 mb-3">Kategori Tes</label>
                        </div>
                        <div class="col-lg">
                            <select name="kategori_test_id" id="kategori_test_id" class="form-select custom-placeholder" data-control="select2" data-placeholder="Pilih Kategori Tes">
                                <option value="" disabled selected>Pilih Kategori Tes</option>
                                @foreach($kategoriTests as $kategoriTest)
                                    <option value="{{ $kategoriTest->id }}">{{ $kategoriTest->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <a href="{{ route('admin.latihan-soal') }}" type="reset" class="btn btn-light btn-active-light-primary me-2">Batalkan</a>
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
    initTinyMCE('textarea#question');
</script>

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
<script>
    //answer_a
        $(document).ready(function () {
        $('input[type="radio"][name="answer_a_type"]').change(function () {
            if ($(this).val() === "text") {
                $('#answer_a').show();
                $('#imageAnswerA').hide();
                $('#file_input_image_answer_a').hide();

            } else if ($(this).val() === "image") {
                $('#answer_a').hide();
                $('#imageAnswerA').show();
                $('#file_input_image_answer_a').show();
            }
        });
    });

    //answer_b
    $(document).ready(function () {
        $('input[type="radio"][name="answer_b_type"]').change(function () {
            if ($(this).val() === "text") {
                $('#answer_b').show();
                $('#imageAnswerB').hide();
                $('#file_input_image_answer_b').hide();

            } else if ($(this).val() === "image") {
                $('#answer_b').hide();
                $('#imageAnswerB').show();
                $('#file_input_image_answer_b').show();
            }
        });
    });

    //answer_c
    $(document).ready(function () {
        $('input[type="radio"][name="answer_c_type"]').change(function () {
            if ($(this).val() === "text") {
                $('#answer_c').show();
                $('#imageAnswerC').hide();
                $('#file_input_image_answer_c').hide();

            } else if ($(this).val() === "image") {
                $('#answer_c').hide();
                $('#imageAnswerC').show();
                $('#file_input_image_answer_c').show();
            }
        });
    });

    //answer_d
    $(document).ready(function () {
        $('input[type="radio"][name="answer_d_type"]').change(function () {
            if ($(this).val() === "text") {
                $('#answer_d').show();
                $('#imageAnswerD').hide();
                $('#file_input_image_answer_d').hide();

            } else if ($(this).val() === "image") {
                $('#answer_d').hide();
                $('#imageAnswerD').show();
                $('#file_input_image_answer_d').show();
            }
        });
    });
</script>

{{-- <script>
    $(document).ready(function () {
        var readingUjians = @json($readingLatihanSoals);

        // Event handler saat pemilihan paket soal berubah
        $('#paket_soal_id').on('change', function () {
            var selectedPaketSoalId = $(this).val();

            $('#reading_texts_id').empty();

            $('#reading_texts_id').append('<option value="" disabled selected>Pilih Content Reading</option>');

            $.each(readingUjians, function (index, readingText) {
                if (readingText.paket_soal_id == selectedPaketSoalId || readingText.paket_soal_id == null) {
                    $('#reading_texts_id').append('<option value="' + readingText.id + '">' + readingText.text_content + '</option>');
                }
            });

            $('#reading_texts_id').val('').trigger('change.select2');
        });
    });
</script> --}}
@endpush

@extends('layouts.app')
@section('title', 'Edit Ujian Soal')
@section('page-title')
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
        <h1 class="page-heading d-flex text-dark fw-bold flex-column justify-content-center my-0">
            Edit Ujian Soal
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
            <form action="{{ route('admin.ujian-soal.update', $soalUjian->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="card-body p-9">
                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="question" class="fs-6 fw-bold mt-2 mb-3">Soal</label>
                        </div>
                        <div class="col-lg">
                            <textarea name="question" id="question" class="form-control" value="{{ $soalUjian->question }}"
                                placeholder="Input Soal">
                                @if (old('question'))
{{ old('question') }}
@elseif(isset($soalUjian))
{{ $soalUjian->question }}
@endif
                            </textarea>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="question_image" class="fs-6 fw-bold mt-2 mb-3">Soal Gambar</label>
                        </div>
                        <div class="col-lg">
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 h-15"
                                id="file_input" name="question_image" type="file">
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG or JPG(MAX.
                                5MB).</p>
                            @if ($soalUjian->question_image)
                                <p>Current Image:</p>
                                <img src="{{ asset('storage/soal/' . $soalUjian->question_image) }}" alt="Current Image"
                                    width="20%" height="20%">
                                <a href="{{ route('admin.soal-ujian.delete_image', ['id' => $soalUjian->id]) }}"
                                    class="text-red-500">Hapus Gambar</a>
                            @else
                                <p>No Image Uploaded.</p>
                            @endif
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="question_audio" class="fs-6 fw-bold mt-2 mb-3">Soal Audio</label>
                        </div>
                        <div class="col-lg">
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 h-15"
                                id="file_input" name="question_audio" type="file">
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">MP3(MAX. 5MB).</p>
                            @if ($soalUjian->question_audio)
                                <audio controls>
                                    <source src="{{ asset('storage/soal/' . $soalUjian->question_audio) }}"
                                        type="audio/mpeg">
                                </audio>
                                <a href="{{ route('admin.soal-ujian.delete_audio', ['id' => $soasoalUjianl->id]) }}"
                                    class="text-red-500">Hapus Audio</a>
                            @else
                                <p>No Audio Uploaded.</p>
                            @endif
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
                            <textarea name="answer_a" id="answer_a" class="form-control z-depth-1 mt-2" rows="3"
                                value="{{ $soalUjian->answer_a }}" placeholder="Input Jawaban A">
                                @if (old('answer_a'))
                                {{ old('answer_a') }}
                                @elseif(isset($soalUjian))
                                {{ $soalUjian->answer_a }}
                                @endif
                                </textarea>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 h-15 mt-2"
                                name="answer_a_image" id="imageAnswerA" type="file" style="display: none;" />
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_image_answer_a"
                                style="display: none;">PNG or JPG(MAX. 5MB).</p>
                            @if ($soalUjian->answer_a_image)
                                <img src="{{ asset('storage/jawaban_a/' . $soalUjian->answer_a_image) }}"
                                    id="image-answer-a" alt="Current Image" width="20%" height="20%">
                                <a href="{{ route('admin.soal-ujian.delete_image', ['id' => $soalUjian->id]) }}"
                                    id="delete-button-a" class="text-red-500">Hapus Gambar</a>
                            @else
                                <p id="keterangan-no-image-a">No Image Uploaded.</p>
                            @endif
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
                            <textarea name="answer_b" id="answer_b" class="form-control z-depth-1 mt-2" rows="3"
                                value="{{ $soalUjian->answer_b }}" placeholder="Input Jawaban B">
                                @if (old('answer_b'))
                                {{ old('answer_b') }}
                                @elseif(isset($soalUjian))
                                {{ $soalUjian->answer_b }}
                                @endif
                            </textarea>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 h-15 mt-2"
                                name="answer_b_image" id="imageAnswerB" type="file" style="display: none;" />
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_image_answer_b"
                                style="display: none;">PNG or JPG(MAX. 5MB).</p>
                            @if ($soalUjian->answer_b_image)
                                <img src="{{ asset('storage/jawaban_b/' . $soalUjian->answer_b_image) }}"
                                    id="image-answer-b" alt="Current Image" width="20%" height="20%">
                                <a href="{{ route('admin.soal-ujian.delete_image', ['id' => $soalUjian->id]) }}"
                                    id="delete-button-b" class="text-red-500">Hapus Gambar</a>
                            @else
                                <p id="keterangan-no-image-b">No Image Uploaded.</p>
                            @endif
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
                            <textarea name="answer_c" id="answer_c" class="form-control z-depth-1 mt-2" rows="3"
                                value="{{ $soalUjian->answer_c }}" placeholder="Input Jawaban C"> @if (old('answer_c'))
                                    {{ old('answer_c') }}
                                    @elseif(isset($soalUjian))
                                    {{ $soalUjian->answer_c }}
                                    @endif </textarea>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 h-15 mt-2"
                                name="answer_c_image" id="imageAnswerC" type="file" style="display: none;" />
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_image_answer_c"
                                style="display: none;">PNG or JPG(MAX. 5MB).</p>
                            @if ($soalUjian->answer_c_image)
                                <img src="{{ asset('storage/jawaban_c/' . $soalUjian->answer_c_image) }}"
                                    id="image-answer-c" alt="Current Image" width="20%" height="20%">
                                <a href="{{ route('admin.soal-ujian.delete_image', ['id' => $soalUjian->id]) }}"
                                    id="delete-button-c" class="text-red-500">Hapus Gambar</a>
                            @else
                                <p id="keterangan-no-image-c">No Image Uploaded.</p>
                            @endif
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
                            <textarea name="answer_d" id="answer_d" class="form-control z-depth-1 mt-2" rows="3"
                                value="{{ $soalUjian->answer_d }}" placeholder="Input Jawaban D"> @if (old('answer_d'))
                                    {{ old('answer_d') }}
                                    @elseif(isset($soalUjian))
                                    {{ $soalUjian->answer_d }}
                                    @endif </textarea>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 h-15 mt-2"
                                name="answer_d_image" id="imageAnswerD" type="file" style="display: none;" />
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_image_answer_d"
                                style="display: none;">PNG or JPG(MAX. 5MB).</p>
                            @if ($soalUjian->answer_d_image)
                                <img src="{{ asset('storage/jawaban_d/' . $soalUjian->answer_d_image) }}"
                                    id="image-answer-d" alt="Current Image" width="20%" height="20%">
                                <a href="{{ route('admin.soal-ujian.delete_image', ['id' => $soalUjian->id]) }}"
                                    id="delete-button-d" class="text-red-500">Hapus Gambar</a>
                            @else
                                <p id="keterangan-no-image-d">No Image Uploaded.</p>
                            @endif
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="correct_answer" class="fs-6 fw-bold mt-2 mb-3">Kunci Jawaban</label>
                        </div>
                        <div class="col-lg">
                            <select name="correct_answer"
                                class="form-select @error('correct_answer') is-invalid @enderror" data-control="select2"
                                data-placeholder="Pilih Kunci Jawaban">
                                <option value="" disabled selected>Pilih Kunci Jawaban</option>
                                <option value="A" {{ $soalUjian->correct_answer == 'A' ? 'selected' : '' }}>A
                                </option>
                                <option value="B" {{ $soalUjian->correct_answer == 'B' ? 'selected' : '' }}>B
                                </option>
                                <option value="C" {{ $soalUjian->correct_answer == 'C' ? 'selected' : '' }}>C
                                </option>
                                <option value="D" {{ $soalUjian->correct_answer == 'D' ? 'selected' : '' }}>D
                                </option>
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
                            <input type="number" name="point_soal" class="form-control"
                                value="{{ $soalUjian->point_soal }}" placeholder="Input Point Soal" />
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
                            <select name="kategori_id" id="kategori_id" class="form-select" data-control="select2">
                                @foreach ($categorySoal as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $category->id == $soalUjian->kategori_id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
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
                            <label for="paket_soal_id" class="fs-6 fw-bold mt-2 mb-3">Paket Soal</label>
                        </div>
                        <div class="col-lg">
                            <select name="paket_soal_id" id="paket_soal_id" class="form-select" data-control="select2">
                                @foreach ($paketSoal as $paket)
                                    <option value="{{ $paket->id }}"
                                        {{ $paket->id == $soalUjian->paket_soal_id ? 'selected' : '' }}>
                                        {{ $paket->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('paket_soal_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="reading_ujian_id" class="fs-6 fw-bold mt-2 mb-3">Content Reading</label>
                        </div>
                        <div class="col-lg">
                            <select name="reading_ujian_id" id="reading_ujian_id" class="form-select custom-placeholder"
                                data-control="select2" data-placeholder="Pilih Content Reading">
                                <option value="" disabled selected>Pilih Content Reading</option>
                                @foreach ($readingUjians as $readingUjian)
                                    <option value="{{ $readingUjian->id }}"
                                        {{ $readingUjian->id == $soalUjian->reading_ujian_id ? 'selected' : '' }}>
                                        {{ $readingUjian->text_content }}
                                    </option>
                                @endforeach
                                <option value="null">Reset Default</option>
                            </select>
                        </div>
                    </div>


                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="kategori_test_id" class="fs-6 fw-bold mt-2 mb-3">Kategori Test</label>
                        </div>
                        <div class="col-lg">
                            <select name="kategori_test_id" id="kategori_test_id" class="form-select"
                                data-control="select2">
                                @foreach ($kategoriTests as $kategoriTest)
                                    <option value="{{ $kategoriTest->id }}"
                                        {{ $kategoriTest->id == $soalUjian->kategori_test_id ? 'selected' : '' }}>
                                        {{ $kategoriTest->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori_test_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <a href="{{ route('admin.ujian-soal') }}" type="reset"
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
        initTinyMCE('textarea#question');
    </script>

    <script>
        //answer_a
        $(document).ready(function() {
            $('input[type="radio"][name="answer_a_type"]').change(function() {
                if ($(this).val() === "text") {
                    $('#answer_a').show();
                    $('#imageAnswerA').hide();
                    $('#file_input_image_answer_a').hide();
                    $('#image-answer-a').hide();
                    $('#delete-button-a').hide();
                    $('#keterangan-no-image-a').hide();
                } else if ($(this).val() === "image") {
                    $('#answer_a').hide();
                    $('#imageAnswerA').show();
                    $('#file_input_image_answer_a').show();
                    $('#image-answer-a').show();
                    $('#delete-button-a').show();
                    $('#keterangan-no-image-a').show();
                }
            });
        });

        //answer_b
        $(document).ready(function() {
            $('input[type="radio"][name="answer_b_type"]').change(function() {
                if ($(this).val() === "text") {
                    $('#answer_b').show();
                    $('#imageAnswerB').hide();
                    $('#file_input_image_answer_b').hide();
                    $('#image-answer-b').hide();
                    $('#delete-button-b').hide();
                    $('#keterangan-no-image-b').hide();
                } else if ($(this).val() === "image") {
                    $('#answer_b').hide();
                    $('#imageAnswerB').show();
                    $('#file_input_image_answer_b').show();
                    $('#image-answer-b').show();
                    $('#delete-button-b').show();
                    $('#keterangan-no-image-b').show();
                }
            });
        });

        //answer_c
        $(document).ready(function() {
            $('input[type="radio"][name="answer_c_type"]').change(function() {
                if ($(this).val() === "text") {
                    $('#answer_c').show();
                    $('#imageAnswerC').hide();
                    $('#file_input_image_answer_c').hide();
                    $('#image-answer-c').hide();
                    $('#delete-button-c').hide();
                    $('#keterangan-no-image-c').hide();
                } else if ($(this).val() === "image") {
                    $('#answer_c').hide();
                    $('#imageAnswerC').show();
                    $('#file_input_image_answer_c').show();
                    $('#image-answer-c').show();
                    $('#delete-button-c').show();
                    $('#keterangan-no-image-c').show();
                }
            });
        });

        //answer_d
        $(document).ready(function() {
            $('input[type="radio"][name="answer_d_type"]').change(function() {
                if ($(this).val() === "text") {
                    $('#answer_d').show();
                    $('#imageAnswerD').hide();
                    $('#file_input_image_answer_d').hide();
                    $('#image-answer-d').hide();
                    $('#delete-button-d').hide();
                    $('#keterangan-no-image-d').hide();

                } else if ($(this).val() === "image") {
                    $('#answer_d').hide();
                    $('#imageAnswerD').show();
                    $('#file_input_image_answer_d').show();
                    $('#image-answer-d').show();
                    $('#delete-button-d').show();
                    $('#keterangan-no-image-d').show();
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {

            let initialPaketSoalId = '{{ $soalUjian->paket_soal_id }}';
            let initialReadingTextsId = '{{ $soalUjian->reading_ujian_id }}';

            var readingTexts = @json($readingUjians);

            // Event handler saat pemilihan paket soal berubah
            $('#paket_soal_id').on('change', function() {
                var selectedPaketSoalId = $(this).val();

                $('#reading_ujian_id').empty();
                $('#reading_ujian_id').append(
                    '<option value="" disabled selected>Pilih Content Reading</option>');

                // Tambahkan opsi konten bacaan yang sesuai dengan paket soal yang dipilih
                $.each(readingTexts, function(index, readingText) {
                    if (readingText.paket_soal_id == selectedPaketSoalId || readingText
                        .paket_soal_id == null) {
                        $('#reading_ujian_id').append('<option value="' + readingText.id + '">' +
                            readingText.text_content + '</option>');
                    }
                });


                $('#reading_ujian_id').val('').trigger('change.select2');
            });

            $('#reading_ujian_id').on('change.select2', function() {
                var selectedReadingTextId = $(this).val();

                // Kondisi reset Default
                if (selectedReadingTextId === 'null') {

                    $(this).val(initialReadingTextsId).trigger('change.select2');
                }
            });

            var selectedPaketSoalId = $('#paket_soal_id').val();
            $.each(readingTexts, function(index, readingText) {
                if (readingText.paket_soal_id == selectedPaketSoalId || readingText.paket_soal_id == null) {
                    $('#reading_ujian_id').append('<option value="' + readingText.id + '">' + readingText
                        .text_content + '</option>');
                }
            });

            $('#paket_soal_id').trigger('change');
            $('#reading_ujian_id').val(initialReadingTextsId).trigger('change.select2');
        });
    </script>
@endpush

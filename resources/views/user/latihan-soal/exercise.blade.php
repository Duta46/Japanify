@extends('layouts.index')

@section('title', 'Latihan Soal')

@section('content')

    @include('user.components.latihan-soal.header')

    <div class="min-h-screen min-w-full bg-white flex flex-col justify-center p-10 shadow">
        <div class="relative w-full max-w-full lg:max-w-6xl xl:max-w-screen-2xl mx-auto">
            <div class="relative bg-white shadow-lg sm:rounded-3xl">
                <div class="px-20 py-6">

                    <!-- nav -->
                    <div class="flex flex-col md:flex-row items-center justify-between mb-4 md:mb-0">
                        <div class="flex items-center justify-center mb-4 md:mb-0">
                            <div class="flex items-center justify-center text-2xl font-bold text-true-gray-800">
                                <span class="me-2">Nomer</span><span>{{ $currentSoalIndex + 1 }}</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-center md:justify-end space-x-4">
                            <span id="waktu"
                                class="me-5 text-lg font-medium text-true-gray-800 hover:text-cool-gray-700 transition duration-150 ease-in-out">
                                Sisa Waktu <span id="hours">01</span>:<span id="minutes">00</span>:<span
                                    id="seconds">00</span>
                            </span>
                            <button data-modal-toggle="default-modal"
                                class="px-6 py-3 rounded-3xl font-medium bg-gradient-to-b from-blue-600 to-blue-700 text-white outline-none focus:outline-none ease-in-out">
                                Daftar Soal
                            </button>
                        </div>
                    </div>
                    <!-- /nav -->

                    <!-- Main modal -->
                    <div id="default-modal" aria-hidden="true"
                        class="hidden overflow-x-hidden overflow-y-auto fixed h-modal md:h-full top-4 left-0 right-0 md:inset-0 z-50 justify-center items-center">
                        <div class="relative w-full max-w-2xl px-4 h-full md:h-auto">
                            <!-- Modal content -->
                            <div class="bg-white rounded-lg shadow relative dark:bg-gray-700">
                                <!-- Modal header -->
                                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-gray-900 text-xl lg:text-2xl font-semibold dark:text-white">
                                        Daftar Soal
                                    </h3>
                                    <button type="button"
                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                        data-modal-toggle="default-modal">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <div class="p-4 space-y-6">
                                    @foreach ($shuffledSoalIds as $index => $soalId)
                                        @php
                                            $soal = $soals->firstWhere('id', $soalId);
                                            $SameCategory = $currentSoal->kategori->id === $soal->kategori->id;
                                        @endphp

                                        @if (!$SameCategory)
                                            @continue
                                        @endif

                                        <button onclick="redirectToQuestion({{ $soalId }})"
                                                class="relative bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mr-1 rounded"
                                                @if (!$SameCategory) disabled @endif>
                                            {{ $index + 1 }}
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- hero section -->
                    <div class="lg:2/6 mt-10 lg:mt-37 lg:ml-16 text-left p-1 md:p-0">
                        <div class="mt-6 text-xl font-light text-true-gray-500 antialiased">
                            @if ($currentSoal)
                                <div class="current-question">

                                    {{-- Tampilan Soal Start --}}
                                    @include('user.components.latihan-soal.soal')
                                    {{-- Tampilan Soal End --}}

                                    <div class="mt-4 grid gap-4">
                                        @include('user.components.latihan-soal.jawaban')
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div
                            class="flex flex-col md:flex-row items-center justify-between mt-3 space-y-2 md:space-y-0 md:space-x-2">
                            @include('user.components.latihan-soal.button-action')
                        </div>
                    </div>
                    <!-- /hero section -->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- Menyimpan Waktu Start --}}
    <script>
        let waktuAwal = sessionStorage.getItem("waktuAwal");
        let notifikasi30Menit = false;

        if (!waktuAwal) {
            waktuAwal = new Date().getTime();
            sessionStorage.setItem("waktuAwal", waktuAwal);
        }

        let x = setInterval(() => {
            let now = new Date().getTime();
            let waktu = 3600000 - (now - waktuAwal);

            let hours = Math.floor((waktu % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            let minutes = Math.floor((waktu % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor((waktu % (1000 * 60)) / 1000);

            document.getElementById("hours").innerText = hours.toString().padStart(2, '0');
            document.getElementById("minutes").innerText = minutes.toString().padStart(2, '0');
            document.getElementById("seconds").innerText = seconds.toString().padStart(2, '0');

            // notifikasi 30 menit
            if (minutes == 30 && seconds == 0 && !notifikasi30Menit) {
                notifikasi30Menit = true
                Swal.fire({
                    title: "Attention!",
                    text: "There's only 30 minutes remaining.",
                    icon: "info",
                    confirmButtonText: "OK"
                });
            }

            // waktu habis
            if (waktu <= 0) {
                clearInterval(x);
                document.getElementById("waktu").innerText = "Waktu Habis";

                Swal.fire({
                    title: "Waktu Habis!",
                    text: "Anda telah melewati batas waktu.",
                    icon: "warning",
                    confirmButtonText: "OK"
                }).then((result) => {
                    // Redirect halaman result jika menekan ok
                    if (result.isConfirmed || result.isDismissed) {
                        window.location.href = "{{ route('user.latihan-soal.result') }}";
                    }
                });
            }
        }, 1000);
    </script>
    {{-- Menyimpan Waktu End --}}

    {{-- Menyimpan data Jawaban Start --}}
    <script>
        function pilihOpsi(opsi) {
            const idPertanyaanSaatIni = '{{ $currentSoal->id }}';
            const selectedLabel = document.querySelector(`label[for=${opsi}]`);
            const jawaban = {
                idPertanyaan: idPertanyaanSaatIni,
                opsiDipilih: opsi,
                kategori: '{{ $currentSoal->kategori->name }}',
                correctAnswer: '{{ $currentSoal->correct_answer }}',
                points: '{{ $currentSoal->point_soal }}',
                idKategori: '{{ $currentSoal->kategori_id }}',
            };

            // Check if the selected label contains an image
            const imageElement = selectedLabel.querySelector('img');
            if (imageElement) {
                const imageUrl = imageElement.getAttribute('src');
                // Here, 'imageUrl' is the URL of the image
                // Convert the image to Base64
                convertImageToBase64(imageUrl, function(base64String) {
                    jawaban.teksJawaban = base64String; // Store the Base64 string
                    sessionStorage.setItem('jawabanSoal_' + idPertanyaanSaatIni, JSON.stringify(jawaban));
                });
            } else {
                jawaban.teksJawaban = selectedLabel.innerText; // Store text as is
                sessionStorage.setItem('jawabanSoal_' + idPertanyaanSaatIni, JSON.stringify(jawaban));
            }
        }

        // Function to convert image URL to Base64
        function convertImageToBase64(url, callback) {
            const img = new Image();
            img.crossOrigin = 'Anonymous';
            img.onload = function() {
                const canvas = document.createElement('canvas');
                const ctx = canvas.getContext('2d');
                canvas.width = img.width;
                canvas.height = img.height;
                ctx.drawImage(img, 0, 0);
                const base64String = canvas.toDataURL('image/png');
                callback(base64String);
            };
            img.src = url;
        }


        function ambilOpsiDipilih() {
            const idPertanyaanSaatIni = '{{ $currentSoal->id }}';
            const dataJawaban = sessionStorage.getItem('jawabanSoal_' + idPertanyaanSaatIni);

            if (dataJawaban) {
                const jawaban = JSON.parse(dataJawaban);
                if (jawaban.idPertanyaan === idPertanyaanSaatIni) {
                    document.getElementById(jawaban.opsiDipilih).checked = true;

                    // Create an image element dynamically
                    const retrievedImage = new Image();
                    retrievedImage.onload = function() {
                        // Assuming 'resultImageContainer' is the container where you want to display the image
                        const resultImageContainer = document.getElementById('resultImageContainer');
                        resultImageContainer.appendChild(retrievedImage); // Append the image
                    };
                    retrievedImage.src = jawaban.teksJawaban; // Set the Base64 string as image source
                }
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            ambilOpsiDipilih();
        });

        document.addEventListener('click', function(event) {
            if (event.target.matches('input[name="bordered-radio"]')) {
                pilihOpsi(event.target.id);
            }
        });

        document.addEventListener('click', function(event) {
            if (event.target.matches('.rounded-md.bg-blue-500, .rounded-md.bg-blue-700')) {
                const opsiDipilih = document.querySelector('input[name="bordered-radio"]:checked');
                if (opsiDipilih) {
                    pilihOpsi(opsiDipilih.id);
                }
            }
        });
    </script>
    {{-- Menyimpan data Jawaban End --}}

    {{-- Navigasi daftar soal start --}}
    <script>
        function redirectToQuestion(soalId) {
            const url = '/soal/{{ $currentSoal->paket_soal_latihan_soal_id }}/' + soalId;
            window.location.href = url;
        }
    </script>
    {{-- Navigasi daftar soal end --}}

    {{-- tombol konfirmasi akhir ujian start --}}
    <script>
        function konfirmasiAkhiriUjian() {
            Swal.fire({
                title: "Apakah anda yakin ?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes",
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Latihan Soal Selesai",
                        text: "Anda telah meyelesaikan latihan soal",
                        icon: "success",
                    }).then(() => {
                        window.location.href = "{{ route('user.latihan-soal.result') }}";
                    });
                }
            });
        }
    </script>
    {{-- tombol konfirmasi akhir ujian end --}}

    <script>
        let currentCategoryId = null;

        function checkCategory(currentCategory, nextCategory, nextQuestionUrl) {
            if (currentCategory !== nextCategory || currentCategoryId !== nextCategory) {
                if (currentCategory !== nextCategory) {
                    Swal.fire({
                        title: "Section Change!",
                        text: "You are moving to the next Section. Are you sure?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            currentCategoryId = nextCategory; // Update current category ID

                            // Tambahkan entri ke dalam history
                            history.pushState({
                                page: nextQuestionUrl
                            }, null, nextQuestionUrl);

                            window.location.href = nextQuestionUrl;
                        }
                    });
                    return false;
                } else {
                    currentCategoryId = currentCategory; // Update current category ID
                }
            }
            return true; // Allow navigation to the next question
        }

        window.onload = function() {
            // Simpan status awal dalam history state
            history.replaceState({
                page: window.location.href
            }, null, window.location.href);

            // Tangkap event ketika pengguna mencoba untuk kembali
            window.addEventListener('popstate', function(event) {
                if (event.state && event.state.page !== window.location.href) {
                    history.pushState({
                        page: window.location.href
                    }, null, window.location.href);
                }
            });
        };
    </script>

<script>
    // Menangkap elemen gambar
    var img = document.getElementById("gambarSoal");

    // Menangkap elemen pop-up
    var modal = document.getElementById("gambarPopUp");
    var modalImg = document.getElementById("modalImg");

    // Mengaktifkan pop-up ketika gambar diklik
    img.onclick = function() {
        modal.style.display = "block";
        modalImg.src = this.src;
    }

    // Menutup pop-up ketika gambar di luar area pop-up diklik
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    // Menutup pop-up ketika tombol close di dalam pop-up diklik
    var span = document.getElementsByClassName("close")[0];
    span.onclick = function() {
        modal.style.display = "none";
    }
</script>
@endpush

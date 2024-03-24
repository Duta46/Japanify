@extends('layouts.index')

@section('title', 'Skor Akhir Latihan Soal')

@section('content')
    @include('user.components.latihan-soal.header')

    <div class="container mx-auto py-6 sm:py-10">

        <div class="mt-2 bg-white shadow-lg rounded-xl p-8">
            <h2 class="text-2xl font-semibold mb-4 text-center">Review Hasil</h2>

            <table id="additionalRows" class=" border-white">

            </table>


            <table id="resultTable" class="table-auto min-w-full border border-gray-300 divide-y divide-gray-300">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">No</th>
                        <th class="py-2 px-4 border-b">Jawaban Kamu</th>
                        <th class="py-2 px-4 border-b">Kategori Soal</th>
                        <th class="py-2 px-4 border-b">Point Soal</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data will be populated here dynamically -->
                </tbody>
            </table>
            <button onclick="logoutAndRedirect()"
                class="px-4 py-2 rounded-md bg-red-500 hover:bg-red-700 text-white font-bold mt-4">
                Kembali ke menu
            </button>
        </div>

        {{-- <br /> --}}
    </div>

@endsection

@push('scripts')
    <script>
        function displayUserAnswers() {
            const resultTableBody = document.querySelector('#resultTable tbody');

            const shuffledSoalIds = {!! json_encode(session('shuffledSoalIds')) !!};

            let questionNumber = 1;
            let totalPoints = 0;

            shuffledSoalIds.forEach(soalId => {
                const dataJawaban = sessionStorage.getItem('jawabanSoal_' + soalId);

                if (dataJawaban) {
                    const jawaban = JSON.parse(dataJawaban);

                    const answerMapping = {
                        'bordered-radio-1': 'A',
                        'bordered-radio-2': 'B',
                        'bordered-radio-3': 'C',
                        'bordered-radio-4': 'D',
                    };

                    const mappedUserAnswer = answerMapping[jawaban.opsiDipilih] || '';

                    const isAnswerCorrect = jawaban.correctAnswer === mappedUserAnswer;

                    let pointsSoal = isAnswerCorrect ? jawaban.points : 0;

                    let resultCellContent = jawaban.teksJawaban;

                    // Check if 'teksJawaban' is a Base64 image
                    if (isBase64Image(jawaban.teksJawaban)) {
                        resultCellContent =
                            `<img src="${jawaban.teksJawaban}" alt="User Image" width="50px" height="50px" />`;
                    }

                    const resultRow = `
                    <tr>
                        <td class="py-2 px-4 border-b">${questionNumber}</td>
                        <td class="py-2 px-4 border-b">${resultCellContent}</td>
                        <td class="py-2 px-4 border-b">${jawaban.kategori}</td>
                        <td class="py-2 px-4 border-b">${pointsSoal}</td>
                    </tr>
                `;
                    resultTableBody.innerHTML += resultRow;

                    // Increment total points
                    totalPoints += parseInt(pointsSoal);

                    questionNumber++;
                }
            });

            // Function to check if the string is a Base64 image
            function isBase64Image(str) {
                return str.startsWith('data:image/');
            }

            // Display the total points in the score recap table
            const totalRow = `
           <tr>
               <td class="py-2 px-4 border-b"></td>
               <td class="py-2 px-4 border-b"><b>Total</b></td>
               <td class="py-2 px-4 border-b"><b>${totalPoints}/100</b></td>
           </tr>
       `;

            // Display the lulus status
            const lulusRow = `
           <tr>
               <td class="py-2 px-4 border-b"></td>
               <td class="py-2 px-4 border-b"><b>Status</b></td>
               <td class="py-2 px-4 border-b"><b>${totalPoints >= 80 ? 'Lulus' : 'Tidak Lulus'}</b></td>
           </tr>
       `;

            const additionalRowsContainer = document.querySelector('#additionalRows');
            additionalRowsContainer.innerHTML = totalRow + lulusRow;
        }

        document.addEventListener('DOMContentLoaded', displayUserAnswers);
    </script>

    <script>
        function logoutAndRedirect() {
            Swal.fire({
                title: 'Kembali ke menu ?',
                // html: '<div style="text-align: center;">Have you record this score yet!!</div>',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Iya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Membersihkan sessionStorage
                    sessionStorage.clear();

                    // Melakukan redirect
                    window.location.href = '/menu';
                }
            });
        }
    </script>


    <script>
        window.onload = function() {
            history.pushState(null, null, window.location.href);
            window.onpopstate = function() {
                history.go(1);
            };
        };
    </script>
@endpush

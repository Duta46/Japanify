@extends('layouts.index')

@section('title', 'Detail Paket Soal Ujian')

@section('content')
    <div class="container mx-auto py-6 sm:py-20 animate-fade-down">
        <div class="max-w-md mx-auto bg-white shadow-lg rounded-xl p-8">
            <div class="flex items-center justify-center">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-mortarboard-fill mr-2 mt-1.5" viewBox="0 0 16 16">
                        <path
                            d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917l-7.5-3.5Z" />
                        <path
                            d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466 4.176 9.032Z" />
                    </svg>
                    <h1 class="text-lg font-medium">
                        {{ $paket->jumlah_soal }} Soal
                    </h1>
                </div>
            </div>
            @if ($paket->jumlah_soal > 0)
                <hr class="mt-4 border-b border-blueGray-600 w-full">
                <div class="divide-y divide-gray-200">
                    {{-- <form method="get"
                        action="{{ route('mulaiTest', ['paketSoalId' => $paket->id, 'soalId' => $firstSoalId]) }}">
                        @csrf --}}
                    <div class="py-6 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                        <div class="relative">
                            <p id="waktu" class="text-base">Waktu pengerjaan ujian selama 2 jam 30 menit.</p>
                            @if ($kategoris)
                                @foreach ($kategoris as $kategori)
                                    <p class="text-base mt-2">{{ $kategori->name }}: {{ $kategori->soal_ujian_count }} Soal
                                    </p>
                                @endforeach
                            @endif
                        </div>
                        <div class="relative mt-4 flex justify-center">
                            <button type="submit" onclick="mulaiTes()"
                                class="inline-flex items-center justify-center px-4 py-2 rounded-md bg-blue-500 hover:bg-blue-700 text-white font-bold">
                                Mulai
                            </button>
                        </div>
                    </div>
                    {{-- </form> --}}
                </div>
            @else
                <p class="mt-4 text-base text-center leading-6 text-gray-700">
                    Tidak ada soal dalam paket ini.
                </p>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let waktuAwal = sessionStorage.getItem("waktuAwal");

        if (!waktuAwal) {
            waktuAwal = new Date().getTime();
            sessionStorage.setItem("waktuAwal", waktuAwal);
        }

        function updateWaktuAwal() {
            waktuAwal = new Date().getTime();
            sessionStorage.setItem("waktuAwal", waktuAwal);
        }

        function mulaiTes() {
        // Update waktu awal
        updateWaktuAwal();

        let paketSoalId = <?php echo json_encode($paket->id); ?>;
        let soalByCategory = <?php echo json_encode($soalByCategory); ?>;

        if (!soalByCategory || Object.keys(soalByCategory).length === 0) {
            // Handle the case where soalByCategory is null or empty
            console.error("Invalid or empty soalByCategory.");
            return;
        }

        // Get the keys of soalByCategory
        let categoryKeys = Object.keys(soalByCategory);

        // Get the index of the first question in the first category
        let questionIndex = 0;

        // Ensure the category index exists
        if (categoryKeys.length > 0) {
            // Get the category key for the first category
            let firstCategoryKey = categoryKeys[0];

            // Ensure the category has questions
            if (soalByCategory[firstCategoryKey].length > questionIndex) {
                // Get the first question from the first category
                let firstQuestion = soalByCategory[firstCategoryKey][questionIndex];

                // Redirect to the exercise page with the question id
                window.location.href = `/exercise/${paketSoalId}/${firstQuestion.id}`;
                return;
            }
        }

        console.error("Invalid category or question index.");
    }
    </script>
@endpush

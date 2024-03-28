<!-- Previous button -->
@if ($previousSoal && $previousSoal->kategori_id === $currentSoal->kategori_id)
    <a href="{{ route('user.latihan-soal.mulaiTest', ['paketSoalId' => $currentSoal->paket_soal_latihan_soal_id, 'soalId' => $previousSoal->id]) }}"
        class="w-full md:w-auto px-4 py-2 rounded-md bg-blue-500 hover:bg-blue-700 text-white font-bold text-center md:text-left">
        Soal Sebelumnya
    </a>
@endif

<!-- Ragu-ragu button -->
<button onclick="tandaiRaguRagu()"
    class="w-full md:w-auto px-4 py-2 rounded-md bg-yellow-500 hover:bg-yellow-500 text-white font-bold text-center md:text-left flex items-center justify-between">
    <div class="flex items-center">
        <!-- Checklist -->
        <input type="checkbox" id="ragu-ragu-checklist" class="mr-2">
        {{ $currentSoal->ragu_ragu ? 'checked' : '' }}
        <label for="ragu-ragu-checklist">Ragu-Ragu</label>
    </div>
</button>

<!-- Next button -->
@if ($nextSoal)
    @php
        $nextQuestionUrl = route('user.latihan-soal.mulaiTest', ['paketSoalId' => $currentSoal->paket_soal_latihan_soal_id, 'soalId' => $nextSoal->id]);
        $currentCategory = $currentSoal->kategori->id;
        $nextCategory = $nextSoal->kategori->id;
    @endphp

    <a href="{{ $nextQuestionUrl }}"
        onclick="return checkCategory('{{ $currentCategory }}', '{{ $nextCategory }}', '{{ $nextQuestionUrl }}')"
        class="w-full md:w-auto px-4 py-2 rounded-md bg-blue-500 hover:bg-blue-700 text-white font-bold text-center md:text-left ml-auto">
        @if ($lastSoal)
            Pindah Sesi
        @else
            Soal Selanjutnya
        @endif
    </a>
@elseif ($nextSoal === null)
    <button onclick="konfirmasiAkhiriUjian()"
        class="w-full md:w-auto px-4 py-2 rounded-md bg-blue-500 hover:bg-blue-700 text-white font-bold text-center md:text-left ml-auto">
        Akhiri Latihan Soal
    </button>
@endif

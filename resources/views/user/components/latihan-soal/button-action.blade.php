<!-- Previous button -->
{{-- @if ($previousSoal && $previousSoal->kategori_id === $currentSoal->kategori_id)
<a href="{{ route('mulaiTest', ['paketSoalId' => $currentSoal->paket_soal_id, 'soalId' => $previousSoal->id]) }}"
    class="w-full md:w-auto px-4 py-2 rounded-md bg-blue-500 hover:bg-blue-700 text-white font-bold text-center md:text-left">
    Previous Question
</a>
@endif --}}


<a href="#"
    class="w-full md:w-auto px-4 py-2 rounded-md bg-blue-500 hover:bg-blue-700 text-white font-bold text-center md:text-left">
    Previous Question
</a>

<!-- Next button -->
{{-- @if ($nextSoal)
@php
    $nextQuestionUrl = route('mulaiTest', ['paketSoalId' => $currentSoal->paket_soal_id, 'soalId' => $nextSoal->id]);
    $currentCategory = $currentSoal->kategori->id;
    $nextCategory = $nextSoal->kategori->id;
@endphp --}}

{{-- <a href="{{ $nextQuestionUrl }}"
    onclick="return checkCategory('{{ $currentCategory }}', '{{ $nextCategory }}', '{{ $nextQuestionUrl }}')"
    class="w-full md:w-auto px-4 py-2 rounded-md bg-blue-500 hover:bg-blue-700 text-white font-bold text-center md:text-left ml-auto">
    @if ($lastSoal)
        Move Session
    @else
        Next Question
    @endif
</a> --}}
<a href="#"
    class="w-full md:w-auto px-4 py-2 rounded-md bg-blue-500 hover:bg-blue-700 text-white font-bold text-center md:text-left ml-auto">
        Move Session
</a>
<button
    class="w-full md:w-auto px-4 py-2 rounded-md bg-blue-500 hover:bg-blue-700 text-white font-bold text-center md:text-left ml-auto">
    End Exam
</button>


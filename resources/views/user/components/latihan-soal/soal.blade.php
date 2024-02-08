@if ($currentSoal->question && $currentSoal->question_image)
    <img class="h-36 max-w-lg rounded-lg" src="{{ asset('storage/soal/' . $currentSoal->question_image) }}" alt="image">
    <p class="mt-4 font-normal">{!! nl2br(e($currentSoal->question)) !!}</p>
@elseif ($currentSoal->question_audio && $currentSoal->question_image)
    <audio controls>
        <source id="soalAudio" src="{{ asset('storage/soal/' . $currentSoal->question_audio) }}" type="audio/mpeg">
    </audio>
    <img class="mt-5 h-36 max-w-lg rounded-lg" src="{{ asset('storage/soal/' . $currentSoal->question_image) }}"
        alt="image">
@elseif ($currentSoal->question && $currentSoal->question_audio)
    <audio controls>
        <source id="soalAudio" src="{{ asset('storage/soal/' . $currentSoal->question_audio) }}" type="audio/mpeg">
    </audio>
    <p class="mt-4 font-normal">{!! nl2br(e($currentSoal->question)) !!}</p>
@elseif ($currentSoal && $currentSoal->kategori->name === 'Reading')
    <div class="mt-6 text-xl font-normal text-true-gray-500 antialiased">
        <p>{{ $currentSoal->ReadingText->text_content }}</p>
    </div>
    <p class="mt-4 font-light">{!! nl2br(e($currentSoal->question)) !!}</p>
@elseif ($currentSoal->question_audio)
    <audio id="soalAudio" controls>
        <source src="{{ asset('storage/soal/' . $currentSoal->question_audio) }}" type="audio/mpeg">
    </audio>
@elseif ($currentSoal->question_image)
    <img class="h-36 max-w-lg rounded-lg" src="{{ asset('storage/soal/' . $currentSoal->question_image) }}"
        alt="image">
@else
    <p class="font-normal">{!! nl2br(e($currentSoal->question)) !!}</p>
@endif

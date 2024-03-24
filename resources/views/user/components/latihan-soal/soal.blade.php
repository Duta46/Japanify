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
    {{-- @elseif ($currentSoal && $currentSoal->kategori->name === 'Reading')
    <div class="mt-6 text-xl font-normal text-true-gray-500 antialiased">
        <p>{{ $currentSoal->text_content }}</p>
    </div>
    <p class="mt-4 font-light">{!! nl2br(e($currentSoal->question)) !!}</p> --}}
@elseif ($currentSoal->question && $currentSoal->image_content)
    <img id="gambarSoal" class="h-36 max-w-lg rounded-lg"
        src="{{ asset('storage/reading-latihan-soal/' . $currentSoal->image_content) }}" alt="image">
    <p class="mt-4 font-normal">{!! nl2br(e($currentSoal->question)) !!}</p>

@elseif ($currentSoal->question && $currentSoal->text_content)
    <div class="mt-6 text-xl font-normal text-true-gray-500 antialiased">
        <p>{!! nl2br(e($currentSoal->text_content)) !!}</p>
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

<div id="gambarPopUp" class="modal" style="display: none;">
    <span class="close" style="position: absolute; top: 15px; right: 35px; color: black; font-size: 40px; font-weight: bold; cursor: pointer;">&times;</span>
    <img id="modalImg" style="margin: auto; display: block; max-width: 80%; max-height: 80%;">
</div>


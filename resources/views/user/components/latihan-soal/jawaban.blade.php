<button class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700">
    <input id="bordered-radio-1" type="radio" value="A" name="bordered-radio"
        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
        {{ old('answer') == 'a' ? 'checked' : '' }}>

    <label for="bordered-radio-1"
        class="w-full py-4 md:py-4 ms-2 text-sm md:text-base font-normal text-gray-900 dark:text-gray-300 flex justify-center items-center space-x-2 md:space-x-4">

        @php
            $answerText = $latihanSoals->answer_a;
            $answerImage = $latihanSoals->answer_a_image;
        @endphp

        @if ($answerText)
            {{ $answerText }}
        @elseif ($answerImage)
            <img id="jawaban-a-image" src="{{ asset('storage/jawaban_a/' . $answerImage) }}" width="10%"
                height="10%">
        @endif
    </label>
</button>

<button class=" flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700">
    <input id="bordered-radio-2" type="radio" value="B" name="bordered-radio"
        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
        {{ old('answer') == 'b' ? 'checked' : '' }}>
    <label for="bordered-radio-2"
        class="w-full py-4 md:py-4 ms-2 text-sm md:text-base font-normal text-gray-900 dark:text-gray-300 flex justify-center items-center space-x-2 md:space-x-4">
        @php
            $answerText = $latihanSoals->answer_b;
            $answerImage = $latihanSoals->answer_b_image;
        @endphp

        @if ($answerText)
            {{ $answerText }}
        @elseif ($answerImage)
            <img src="{{ asset('storage/jawaban_b/' . $answerImage) }}" width="10%" height="10%">
        @endif
    </label>
</button>
<button class=" flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700">
    <input id="bordered-radio-3" type="radio" value="" name="bordered-radio"
        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
        {{ old('answer') == 'c' ? 'checked' : '' }}>
    <label for="bordered-radio-3"
        class="w-full py-4 md:py-4 ms-2 text-sm md:text-base font-normal text-gray-900 dark:text-gray-300 flex justify-center items-center space-x-2 md:space-x-4">
        @php
            $answerText = $latihanSoals->answer_c;
            $answerImage = $latihanSoals->answer_c_image;
        @endphp

        @if ($answerText)
            {{ $answerText }}
        @elseif ($answerImage)
            <img src="{{ asset('storage/jawaban_c/' . $answerImage) }}" width="10%" height="10%">
        @endif
    </label>
</button>
<button class=" flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700"
    {{ old('answer') == 'd' ? 'checked' : '' }}>
    <input id="bordered-radio-4" type="radio" value="" name="bordered-radio"
        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">

    <label for="bordered-radio-4"
        class="w-full py-4 md:py-4 ms-2 text-sm md:text-base font-normal text-gray-900 dark:text-gray-300 flex justify-center items-center space-x-2 md:space-x-4">
        @php
            $answerText = $latihanSoals->answer_d;
            $answerImage = $latihanSoals->answer_d_image;
        @endphp

        @if ($answerText)
            {{ $answerText }}
        @elseif ($answerImage)
            <img src="{{ asset('storage/jawaban_d/' . $answerImage) }}" width="10%" height="10%">
        @endif
    </label>
</button>

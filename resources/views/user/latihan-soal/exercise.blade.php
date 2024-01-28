<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Latihan Soal | Japanify</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    @include('user.components.latihan-soal.header')

    <div class="min-h-screen min-w-full bg-white flex flex-col justify-center p-10 shadow">
        <div class="relative w-full max-w-full lg:max-w-6xl xl:max-w-screen-2xl mx-auto">
            <div class="relative bg-white shadow-lg sm:rounded-3xl">
                <div class="px-20 py-6">

                    <!-- nav -->
                    <div class="flex flex-col md:flex-row items-center justify-between mb-4 md:mb-0">
                        <div class="flex items-center justify-center mb-4 md:mb-0">
                            <div class="flex items-center justify-center text-2xl font-bold text-true-gray-800">
                                <span class="me-2">Number</span><span>1</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-center md:justify-end space-x-4">
                            <span id="waktu"
                                class="me-5 text-lg font-medium text-true-gray-800 hover:text-cool-gray-700 transition duration-150 ease-in-out">
                                Remaining Time <span id="hours">01</span>:<span id="minutes">00</span>:<span
                                    id="seconds">00</span>
                            </span>
                            <button data-modal-toggle="default-modal"
                                class="px-6 py-3 rounded-3xl font-medium bg-gradient-to-b from-blue-600 to-blue-700 text-white outline-none focus:outline-none ease-in-out">
                                Question List
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
                                        Question List
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
                                {{-- <div class="p-4 space-y-6">
                                    @foreach ($soals as $index => $soal)
                                        @php
                                            $SameCategory = $currentSoal->kategori->id === $soal->kategori->id;
                                        @endphp

                                        @if (!$SameCategory)
                                            @continue
                                        @endif

                                        <button onclick="redirectToQuestion({{ $soal->id }})"
                                            class="relative bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mr-1 rounded"
                                            @if (!$SameCategory) disabled @endif>
                                            {{ $index + 1 }}
                                        </button>
                                    @endforeach
                                </div> --}}
                            </div>
                        </div>
                    </div>

                    <!-- hero section -->
                    <div class="lg:2/6 mt-10 lg:mt-37 lg:ml-16 text-left p-1 md:p-0">
                        <div class="mt-6 text-xl font-light text-true-gray-500 antialiased">
                            {{-- @if ($currentSoal) --}}
                                <div class="current-question">

                                    {{-- Tampilan Soal Start --}}
                                    @include('user.components.latihan-soal.soal')
                                    {{-- Tampilan Soal End --}}

                                    <div class="mt-4 grid gap-4">
                                        @include('user.components.latihan-soal.jawaban')
                                    </div>
                                </div>
                            {{-- @endif --}}
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
</body>

</html>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Japanify</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/gh/Loopple/loopple-public-assets@main/motion-tailwind/motion-tailwind.css"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body class="bg-white">
    <div class="container flex flex-col mx-auto bg-white">
        <div class="relative flex flex-wrap items-center justify-between w-full bg-white group py-8 shrink-0">
            <div>
                <img class="h-8"
                    src="https://raw.githubusercontent.com/Loopple/loopple-public-assets/main/motion-tailwind/img/logos/logo-nav-0.png">
            </div>
            <div class="items-center justify-between hidden gap-12 text-black md:flex">
                <a class="text-sm font-normal text-dark-grey-700 hover:text-dark-grey-900"
                    href="{{ route('user.home') }}">Home</a>
                <a class="text-sm font-normal text-dark-grey-700 hover:text-dark-grey-900"
                    href="{{ route('user.informasi-test') }}">Informasi Tes</a>
                <a class="text-sm font-normal text-dark-grey-700 hover:text-dark-grey-900"
                    href="{{ route('user.statistic') }}">Statistic</a>
            </div>
            <div class="items-center hidden gap-8 md:flex">
                @auth
                    @if (isset($username))
                        <span class="text-sm font-normal text-gray-800">Welcome, {{ $username }}</span>
                    @else
                        <span class="text-sm font-normal text-gray-800">Welcome, {{ Auth::user()->username }}</span>
                    @endif
                    <a href="{{ route('user.logout') }}" class="text-sm font-normal text-gray-800">Logout</a>
                @else
                    <a href="{{ route('user.login') }}"
                        class="flex items-center text-sm font-normal text-gray-800 hover:text-gray-900 transition duration-300">Log
                        In</a>
                    <a href="{{ route('user.register') }}"
                        class="flex items-center px-4 py-2 text-sm font-bold rounded-xl bg-purple-blue-100 text-purple-blue-600 hover:bg-purple-blue-600 hover:text-white transition duration-300">Register</a>
                @endauth
            </div>
            <button onclick="(() => { this.closest('.group').classList.toggle('open')})()" class="flex md:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none">
                    <path
                        d="M3 8H21C21.2652 8 21.5196 7.89464 21.7071 7.70711C21.8946 7.51957 22 7.26522 22 7C22 6.73478 21.8946 6.48043 21.7071 6.29289C21.5196 6.10536 21.2652 6 21 6H3C2.73478 6 2.48043 6.10536 2.29289 6.29289C2.10536 6.48043 2 6.73478 2 7C2 7.26522 2.10536 7.51957 2.29289 7.70711C2.48043 7.89464 2.73478 8 3 8ZM21 16H3C2.73478 16 2.48043 16.1054 2.29289 16.2929C2.10536 16.4804 2 16.7348 2 17C2 17.2652 2.10536 17.5196 2.29289 17.7071C2.48043 17.8946 2.73478 18 3 18H21C21.2652 18 21.5196 17.8946 21.7071 17.7071C21.8946 17.5196 22 17.2652 22 17C22 16.7348 21.8946 16.4804 21.7071 16.2929C21.5196 16.1054 21.2652 16 21 16ZM21 11H3C2.73478 11 2.48043 11.1054 2.29289 11.2929C2.10536 11.4804 2 11.7348 2 12C2 12.2652 2.10536 12.5196 2.29289 12.7071C2.48043 12.8946 2.73478 13 3 13H21C21.2652 13 21.5196 12.8946 21.7071 12.7071C21.8946 12.5196 22 12.2652 22 12C22 11.7348 21.8946 11.4804 21.7071 11.2929C21.5196 11.1054 21.2652 11 21 11Z"
                        fill="black"></path>
                </svg>
            </button>
            <div
                class="absolute flex md:hidden transition-all duration-300 ease-in-out flex-col items-start shadow-main justify-center w-full gap-3 overflow-hidden bg-white max-h-0 group-[.open]:py-4 px-4 rounded-2xl group-[.open]:max-h-64 top-full">
                <a class="text-sm font-normal text-dark-grey-700 hover:text-dark-grey-900"
                    href="{{ route('user.home') }}">Home</a>
                <a class="text-sm font-normal text-dark-grey-700 hover:text-dark-grey-900"
                    href="{{ route('user.informasi-test') }}">Informasi Tes</a>
                <a class="text-sm font-normal text-dark-grey-700 hover:text-dark-grey-900"
                    href="{{ route('user.statistic') }}">Statistic</a>
                @auth
                    @if (isset($username))
                        <span class="text-sm font-normal text-gray-800">Welcome, {{ $username }}</span>
                    @else
                        <span class="text-sm font-normal text-gray-800">Welcome, {{ Auth::user()->username }}</span>
                    @endif
                    <a href="{{ route('user.logout') }}" class="text-sm font-normal text-dark-grey-700 hover:text-dark-grey-900">Logout</a>
                @else
                    <a href="{{ url()->to('user/login') }}" class="flex items-center text-sm font-normal text-black">Log
                        In</a>
                    <a href="{{ route('user.register') }}"
                        class="flex items-center px-4 py-2 text-sm font-bold rounded-xl bg-purple-blue-100 text-purple-blue-600 hover:bg-purple-blue-600 hover:text-white transition duration-300">Sign
                        Up</a>
                @endauth

            </div>
        </div>
    </div>
    <main class="container">
        <div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary">
            <div class="col-lg-6 px-0">
                <h1 class="display-4 fst-italic">Simulasi Test JLPT Online</h1>
                <p class="lead my-3">Tes JLPT dibutuhkan buat macam-macam keperluan. Jadi, sangat penting
                    bagi kamu untuk meraih skor terbaik setelah menjalaninya. Yuk, berlatih
                    bersama lewat simulasi tes online JLPT <span class="fw-bold">GRATIS</span> dari Japanify!</p>
                {{-- <p class="lead mb-0"><a href="#" class="text-body-emphasis fw-bold">Continue reading...</a></p> --}}
                <a href="{{ route('user.menu') }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                    Test Simulasi JLPT Sekarang
                </a>
            </div>
        </div>

        <div class="px-2 py-3 mt-5 text-center">
            <h1 class="display-5 fw-bold text-body-emphasis fs-4 text-2xl">Apa itu JLPT ?</h1>
            <div class="col-lg-6 mx-auto">
                <p class="lead mt-4 fs-5">JLPT adalah ujian berbahasa Jepang yang diperlukan untuk mendaftar kerja,
                    magang, atau kuliah di Jepang.</p>

                <div class="border-t-4 border-blue-500 mt-5 mx-auto w-28"></div>
            </div>
        </div>

        <div class="px-2 py-1 my-1 text-center">
            <h1 class="display-5 fw-bold text-body-emphasis fs-4 text-2xl">Mengapa Harus Ikut Tes JLPT ?</h1>
        </div>

    </main>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>

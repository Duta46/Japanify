<header class='mt-1'>
    <nav class="px-4 lg:px-6 py-2.5">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
            <div class="flex items-center">
                <img src="{{ asset('assets/images/Japanify.jpeg')}}"
                    class="mr-3 w-24 sm:h-24 rounded-lg object-cover" alt="SJI Logo" />
            </div>
            @if (!request()->is('skor-akhir'))
                @if ($currentSoal && $currentSoal->kategori)
                    <div class="flex items-center lg:order-1">
                        <p class="font-medium text-2xl px-2 lg:px-5 py-2 lg:py-2.5">
                            {{ $currentSoal->kategori->name }}
                        </p>
                    </div>
                @endif
            @endif
            <div class="flex items-center lg:order-2">
                <p class="font-normal text-lg px-2 lg:px-5 py-2 lg:py-2.5">
                    {{ Auth::user()->username }} <i class="fa-solid fa-graduation-cap"></i>
                </p>
            </div>
            {{-- <div class="justify-between items-center w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu-2">
                <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                    <li>
                        <p class="block text-2xl py-2 pr-4 pl-3 lg:border-0 lg:hover:text-primary-700 lg:p-0">{{ $currentKategori->name }}</p>
                    </li>
                </ul>
            </div> --}}
        </div>
    </nav>
</header>

@extends('layouts.index')

@section('title', 'Paket Soal Latihan Soal')

@section('content')
    <div class="container mx-auto mt-36 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md mx-auto bg-white shadow-lg sm:rounded-xl sm:p-6">
            <h1 class="text-lg font-semibold mb-3 text-center">Pilih Paket Soal :</h1>
            <hr class="mt-3 border-b-1 border-blueGray-600" />
            <div class="mt-3">
                @if ($jumlahPaketSoal > 0)
                    <div
                        class="relative bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <select name="paketSoals" id="paketSoals" class="w-full bg-gray-50 outline-none">
                            @foreach ($paketSoals as $paketSoal)
                                <option value="{{ $paketSoal->id }}">{{ $paketSoal->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-4 text-center">
                        <button type="button" id="lanjutkan"
                            class="inline-flex items-center justify-center px-4 py-2 rounded-md bg-blue-500 hover:bg-blue-700 text-white font-bold">
                            Continue
                        </button>
                    </div>
                @else
                    <p class="font-medium text-center">Tidak Ada Paket Soal</p>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.getElementById('lanjutkan').addEventListener('click', function() {
            let selectedPackage = document.getElementById('paketSoals').value;
            window.location.href = '/detail-paket-soal/' + selectedPackage;
        });
    </script>
@endpush

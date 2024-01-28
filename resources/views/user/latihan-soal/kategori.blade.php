<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Kategori | Japanify</title>
</head>

<body>
    <div class="container mx-auto mt-36 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md mx-auto bg-white shadow-lg sm:rounded-xl sm:p-6">
            <h1 class="text-lg font-semibold mb-3 text-center">Pilih Kategori :</h1>
            <hr class="mt-3 border-b-1 border-blueGray-600" />
            <form action="{{ route('exercise') }}" method="GET">
            <div class="mt-3">
                <div
                    class="relative bg-gray-50 border border-gray-300 text-gay-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <select name="kategoris" id="kategoris" class="w-full bg-gray-50 outline-none">
                        @foreach ($kategoris as $kategori )
                        <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-4 text-center">
                    <button type="submit" id="lanjutkan"
                        class="inline-flex items-center justify-center px-4 py-2 rounded-md bg-blue-500 hover:bg-blue-700 text-white font-bold">
                        Mulai
                    </button>
                </div>
            </div>
        </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>



    </script>
</body>
</html>

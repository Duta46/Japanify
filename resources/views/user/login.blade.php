<!DOCTYPE html>
<html>

<head>
    <title>Login | Japanify</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/gh/Loopple/loopple-public-assets@main/motion-tailwind/motion-tailwind.css"
        rel="stylesheet">
    <link rel="icon" type="image/jpeg" href="assets/images/Japanify.jpeg" />
</head>

<body class="bg-white rounded-lg py-2">
    <div class="container flex flex-col mx-auto bg-white rounded-lg pt-7 my-4">
        <div class="flex justify-center w-full h-full my-auto xl:gap-14 lg:justify-normal md:gap-5 draggable">
            <div class="flex items-center justify-center w-full lg:p-12">
                <div class="flex items-center xl:p-10">
                    <form action="{{ route('login.auth') }}" method="POST"
                        class="flex flex-col w-full h-full pb-6 text-center bg-white rounded-3xl">
                        @error('credentials')
                            <div style="color: red;">{{ $message }}</div>
                        @enderror
                        @csrf
                        <h3 class="mb-3 text-4xl font-extrabold text-dark-grey-900">Log In</h3>
                        <p class="mb-4 text-grey-700">Enter your email and password</p>
                        {{-- <a
                            class="flex items-center justify-center w-full py-4 mb-6 text-sm font-medium transition duration-300 rounded-2xl text-grey-900 bg-grey-300 hover:bg-grey-400 focus:ring-4 focus:ring-grey-300">
                            <img class="h-5 mr-2"
                                src="https://raw.githubusercontent.com/Loopple/loopple-public-assets/main/motion-tailwind/img/logos/logo-google.png"
                                alt="">
                            Log in with Google
                        </a> --}}
                        <div class="flex items-center mb-3">
                            <hr class="h-0 border-b border-solid border-grey-500 grow">
                            <p class="mx-4 text-grey-600">or</p>
                            <hr class="h-0 border-b border-solid border-grey-500 grow">
                        </div>
                        <label for="email" class="mb-2 text-sm text-start text-grey-900">Email</label>
                        <input id="email" name="email" type="email" placeholder="johndoe@gmail.com" required
                            class="flex items-center w-full px-5 py-4 mr-2 text-sm font-medium outline-none focus:bg-grey-400 mb-7 placeholder:text-grey-700 bg-grey-200 text-dark-grey-900 rounded-2xl" />

                        <label for="password" class="mb-2 text-sm text-start text-grey-900">Password</label>
                        <input id="password" name="password" type="password" placeholder="********" required
                            class="flex items-center w-full px-5 py-4 mb-5 mr-2 text-sm font-medium outline-none focus:bg-grey-400 placeholder:text-grey-700 bg-grey-200 text-dark-grey-900 rounded-2xl" />

                        <div class="flex flex-row justify-between mb-8">
                            <label class="relative inline-flex items-center mr-3 cursor-pointer select-none">
                                <input type="checkbox" checked value="" class="sr-only peer">
                                <div
                                    class="w-5 h-5 bg-white border-2 rounded-sm border-grey-500 peer peer-checked:border-0 peer-checked:bg-blue-500">
                                    <img class=""
                                        src="https://raw.githubusercontent.com/Loopple/loopple-public-assets/main/motion-tailwind/img/icons/check.png"
                                        alt="tick">
                                </div>
                                <span class="ml-3 text-sm font-normal text-grey-900">Keep me logged in</span>
                            </label>
                            {{-- <a href="{{ route('forgot-password') }}" class="mr-4 text-sm font-medium text-blue-500">Lupa Password ?</a> --}}
                        </div>
                        <button type="submit"
                            class="w-full px-6 py-5 mb-5 text-sm font-bold leading-none text-white bg-blue-500 rounded-2xl">Log
                            in</button>
                        <p class="text-sm leading-relaxed text-grey-900">Belum Punya Akun ? <a
                                href="{{ route('user.register') }}" class="font-bold text-grey-700">Buat Akun</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<html>

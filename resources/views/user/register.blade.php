<!DOCTYPE html>
<html>

<head>
    <title>Register | Japanify</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/gh/Loopple/loopple-public-assets@main/motion-tailwind/motion-tailwind.css"
        rel="stylesheet">
</head>

<body class="bg-white rounded-lg py-2">
    <div class="container flex flex-col mx-auto bg-white rounded-lg pt-5 my-5">
        <div class="flex justify-center w-full h-full my-auto xl:gap-14 lg:justify-normal md:gap-5 draggable">
            <div class="flex items-center justify-center w-full lg:p-12">
                <div class="flex items-center xl:p-10">
                    <form action="{{ route('user.register.store') }}" method="POST"
                        class="flex flex-col w-full h-full pb-6 text-center bg-white rounded-3xl">
                        @csrf
                        <h3 class="mb-3 text-4xl font-extrabold text-dark-grey-900">Register</h3>

                        <label for="name" class="mb-2 text-sm text-start text-grey-900">Name*</label>
                        <input id="name" name="name" value="{{ old('name') }}" type="text" placeholder="Masukan nama"
                            required
                            class="flex items-center w-full px-5 py-4 mr-2 text-sm font-medium outline-none focus:bg-grey-400 mb-7 placeholder:text-grey-700 bg-grey-200 text-dark-grey-900 rounded-2xl" />
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                        <label for="username" class="mb-2 text-sm text-start text-grey-900">Username*</label>
                        <input id="username" name="username" value="{{ old('username') }}" type="text"
                            placeholder="Masukan username" required
                            class="flex items-center w-full px-5 py-4 mb-5 mr-2 text-sm font-medium outline-none focus:bg-grey-400 placeholder:text-grey-700 bg-grey-200 text-dark-grey-900 rounded-2xl" />
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                        <label for="email" class="mb-2 text-sm text-start text-grey-900">Email*</label>
                        <input id="email" name="email" value="{{ old('email') }}" type="email" placeholder="Masukan email"
                            required
                            class="flex items-center w-full px-5 py-4 mb-5 mr-2 text-sm font-medium outline-none focus:bg-grey-400 placeholder:text-grey-700 bg-grey-200 text-dark-grey-900 rounded-2xl" />
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                        <label for="password" class="mb-2 text-sm text-start text-grey-900">Password*</label>
                        <input id="password" name="password" value="{{ old('password') }}" type="password"
                            placeholder="Masukan password" required
                            class="flex items-center w-full px-5 py-4 mb-5 mr-2 text-sm font-medium outline-none focus:bg-grey-400 placeholder:text-grey-700 bg-grey-200 text-dark-grey-900 rounded-2xl" />
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                        <button
                        type="submit"
                            class="w-full px-6 py-5 mb-5 text-sm font-bold leading-none text-white md:w-96 rounded-2xl bg-blue-500">Register</button>

                        <p class="text-sm leading-relaxed text-grey-900">Sudah punya akun ? <a
                                href="{{ route('user.login') }}" class="font-bold text-grey-700">Log in</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<html>

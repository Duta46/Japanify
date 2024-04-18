<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/jpeg" href="assets/images/Japanify.jpeg" />
    <title>Lupa Password</title>
</head>
<body>
    <!-- component -->
<main id="content" role="main" class="w-full max-w-md mx-auto p-6">
    <div class="mt-7 bg-white  rounded-xl shadow-lg dark:bg-gray-800 dark:border-gray-700">
      <div class="p-4 sm:p-7">
        <div class="text-center">
          <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">Lupa Password ?</h1>
          <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
            Ingat Password ?
            <a class="text-blue-600 decoration-2 hover:underline font-medium" href="#">
              Login
            </a>
          </p>
        </div>

        <div class="mt-5">
          <form action="{{ route('forgot-password-act')}}" method="POST">
            @csrf
            <div class="grid gap-y-4">
              <div>
                <label for="email" class="block text-sm font-bold ml-1 mb-2 dark:text-white">Email</label>
                <div class="relative">
                  <input type="email" id="email" name="email" class="py-3 px-4 block w-full border-2 border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 shadow-sm" required aria-describedby="email-error">
                </div>
                {{-- <p class="hidden text-xs text-red-600 mt-2" id="email-error">Please include a valid email address so we can get back to you</p> --}}
              </div>
              @error('email')
                <small class="text-red-600">{{$message}}</small>
              @enderror
              <button type="submit" class="py-3 px-4 inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-semibold bg-blue-500 text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all text-sm dark:focus:ring-offset-gray-800">Reset password</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </main>
  <script>
        document.addEventListener('DOMContentLoaded', function() {
        const successMessage = "{{ session('success') }}";

        if (successMessage) {
            Swal.fire({
                icon: 'success',
                title: 'Password reset link sent!',
                text: 'Periksa email Anda untuk instruksi lebih lanjut.',
                showConfirmButton: false,
                timer: 3000
            });
        }
    });
</script>
</body>
</html>

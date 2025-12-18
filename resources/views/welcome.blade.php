<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Perpus Digital</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-gray-50 text-black/50 dark:text-white/50">
        <div class="min-h-screen flex flex-col justify-center items-center">
            
            <div class="w-full max-w-md px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg text-center">
                
                <div class="flex justify-center mb-6">
                    <img src="{{ asset('images/e-lib.png') }}" alt="Logo E-Lib" class="w-24 h-24 object-contain">
                </div>

                <h1 class="text-3xl font-bold text-gray-900 mb-2">Selamat Datang!</h1>
                <p class="text-gray-600 mb-8">
                    Silakan masuk untuk mengakses ribuan koleksi buku di Perpus Digital kami.
                </p>

                @if (Route::has('login'))
                    <div class="flex flex-col gap-3">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="w-full inline-flex justify-center items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Ke Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="w-full inline-flex justify-center items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Masuk (Login)
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="w-full inline-flex justify-center items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                    Daftar Akun Baru
                                </a>
                            @endif
                        @endauth
                    </div>
                @endif

            </div>
            
            <div class="mt-8 text-sm text-gray-500">
                &copy; {{ date('Y') }} Perpus Digital. All rights reserved.
            </div>
        </div>
    </body>
</html>
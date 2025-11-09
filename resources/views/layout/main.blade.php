<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container d-flex align-items-center">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="{{ asset('images/digitech.png') }}" alt="Logo Digitech" height="40" class="me-2">
            <span>GEMI</span>
        </a>
        <div class="navbar-nav ms-auto">
            <a class="nav-link" href="/profil">Profil</a>
            <a class="nav-link" href="/galeri">Galeri</a>
            <a class="nav-link" href="/kontak">Kontak</a>
        </div>
    </div>
</nav>

    {{-- Konten --}}
    <div class="container mt-4">
        @yield('content')
    </div>

    {{-- Footer --}}
    <footer class="bg-light text-center py-3 mt-4 border-top">
        <small>&copy; {{ date('Y') }} Firdaus Syazwana Handyana Putra</small>
    </footer>

</body>
</html>

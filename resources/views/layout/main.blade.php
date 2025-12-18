<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" src="{{ asset('images/e-lib.png') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        body {
            font-family: "Garamond", "Times New Roman", serif;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

</head>

<body>

    {{-- Navbar --}}
    <nav class="navbar navbar-dark bg-dark">
        <div class="container d-flex align-items-center justify-content-between">

            <!-- Logo -->
            <a class="navbar-brand d-flex align-items-center" href="/">
                <img src="{{ asset('images/e-lib.png') }}" alt="Logo Digitech" height="40" class="me-2">
                <span>E-Library</span>
            </a>

            <!-- Desktop Menu -->
            <ul class="navbar-nav flex-row d-none d-lg-flex ms-3">
                <li class="nav-item me-3">
                    <a class="nav-link" href="/dashboard">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/books/index">Book List</a>
                </li>
            </ul>

            <!-- Right Side -->
            <div class="d-flex align-items-center">

                @guest
                    <a class="nav-link text-white me-3 d-none d-lg-inline" href="{{ route('login') }}">Login</a>
                    <a class="nav-link text-white d-none d-lg-inline" href="{{ route('register') }}">Daftar</a>
                @endguest

                @auth
                    <!-- Desktop user dropdown -->
                    <div class="dropdown d-none d-lg-block">
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button"
                            data-bs-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profil</a></li>
                            <li><a class="dropdown-item" href="/galeri">Galeri</a></li>
                            <li><a class="dropdown-item" href="/kontak">Kontak</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endauth

                <!-- MOBILE HAMBURGER (untuk dropdown kecil) -->
                <div class="dropdown d-lg-none">
                    <button class="btn btn-outline-light px-2 py-1" data-bs-toggle="dropdown">
                        <svg width="20" height="20" fill="#fff" viewBox="0 0 20 20">
                            <path d="M3 6h14M3 10h14M3 14h14" stroke="#fff" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </button>

                    <!-- MOBILE MENU DROPDOWN -->
                    <ul class="dropdown-menu dropdown-menu-end">

                        <li><a class="dropdown-item" href="/dashboard">Dashboard</a></li>
                        <li><a class="dropdown-item" href="/books/index">Book List</a></li>

                        @guest
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
                            <li><a class="dropdown-item" href="{{ route('register') }}">Daftar</a></li>
                        @endguest

                        @auth
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profil</a></li>
                            <li><a class="dropdown-item" href="/galeri">Galeri</a></li>
                            <li><a class="dropdown-item" href="/kontak">Kontak</a></li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        @endauth

                    </ul>
                </div>

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

<script>
    $(document).ready(function() {

        if (!$.fn.DataTable.isDataTable('#booksTable')) {

            window.booksTable = $('#booksTable').DataTable({
                pageLength: 10,
                lengthMenu: [10, 100, 1000],
                columnDefs: [{
                        targets: 1,
                        width: "40px"
                    } // contoh set width ikon
                ]
            });

        }

    });
</script>

</html>

{{--
    Layout utama (halaman setelah login).
    Isi halaman diletakkan di @section('content'); menu aktif otomatis dari nama route.
--}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} - Dashboard Siswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
</head>
<body>

<h2 class="sr-only">SmaCan Dashboard Siswa</h2>

<div class="app">
    <nav class="sidebar">
        <div class="logo"><i class="ti ti-leaf logo-icon" aria-hidden="true"></i> SmaCan</div>

        <a class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
            <i class="ti ti-home" aria-hidden="true"></i> Home
        </a>
        <a class="nav-item {{ request()->routeIs('lokasi') ? 'active' : '' }}" href="{{ route('lokasi') }}">
            <i class="ti ti-map-pin" aria-hidden="true"></i> Lokasi
        </a>
        <a class="nav-item {{ request()->routeIs('edukasi') ? 'active' : '' }}" href="{{ route('edukasi') }}">
            <i class="ti ti-book" aria-hidden="true"></i> Edukasi
        </a>
        <a class="nav-item {{ request()->routeIs('laporan.*') ? 'active' : '' }}" href="{{ route('laporan.index') }}">
            <i class="ti ti-upload" aria-hidden="true"></i> Laporan Saya
        </a>
        <a class="nav-item {{ request()->routeIs('point') ? 'active' : '' }}" href="{{ route('point') }}">
            <i class="ti ti-star" aria-hidden="true"></i> Point
        </a>
        <a class="nav-item {{ request()->routeIs('profile') ? 'active' : '' }}" href="{{ route('profile') }}">
            <i class="ti ti-user-circle" aria-hidden="true"></i> Profile
        </a>

        <div class="nav-bottom">
            {{-- Logout harus POST; link ini men-submit form tersembunyi agar tampilan tetap sama --}}
            <a class="nav-item logout" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="ti ti-logout" aria-hidden="true"></i> Keluar
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none">@csrf</form>
        </div>
    </nav>

    <main class="main active-page">
        @yield('content')
    </main>
</div>

<div class="toast" id="toast"></div>

<script>window.APP_BASE_URL = '{{ rtrim(url('/'), '/') }}';</script>
<script src="{{ asset('assets/js/app.js') }}"></script>
@stack('scripts')
</body>
</html>

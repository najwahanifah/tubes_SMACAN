<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - {{ config('app.name') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
</head>
<body>
<div class="auth-wrapper">
    <div class="auth-card">
        <div class="auth-logo"><i class="ti ti-leaf" aria-hidden="true"></i> SmaCan</div>
        <p class="auth-subtitle">Jaga Sekolah, Jaga Bumi — Masuk ke akunmu</p>

        @include('partials.flash')

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="nama@smacan.sch.id" required autofocus
                       value="{{ old('email') }}">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password" required>
            </div>
            <div class="form-actions" style="margin-top:8px">
                <button type="submit" class="btn-primary" style="width:100%; justify-content:center">
                    <i class="ti ti-login" aria-hidden="true"></i> Masuk
                </button>
            </div>
        </form>

        <div class="auth-footer">
            Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
        </div>
    </div>
</div>
<script src="{{ asset('assets/js/app.js') }}"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login CMS | {{ setting('site_name', config('app.name')) }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body class="auth-page">
    <div class="auth-visual" style="--cover: url('https://picsum.photos/seed/login-cover/1200/1600')">
        <div>
            <span class="brand-mark lg"><x-icon name="compass" size="28" /></span>
            <h1>{{ setting('site_name', config('app.name')) }}</h1>
            <p>Kelola destinasi, paket tour, artikel, dan booking dalam satu dashboard.</p>
        </div>
    </div>

    <div class="auth-form-wrap">
        <form method="POST" action="{{ route('login.store') }}" class="auth-form">
            @csrf
            <h2>Selamat Datang 👋</h2>
            <p class="muted">Masuk ke CMS Dashboard untuk melanjutkan.</p>

            @include('admin.partials.alerts')

            <label class="field">
                <span>Email</span>
                <input class="input" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="admin@tourntravel.test">
            </label>
            <label class="field">
                <span>Password</span>
                <div class="password-wrap">
                    <input class="input" type="password" name="password" id="password" required placeholder="••••••••">
                    <button type="button" class="password-toggle" onclick="const p=document.getElementById('password');p.type=p.type==='password'?'text':'password'" aria-label="Tampilkan password"><x-icon name="eye" size="18" /></button>
                </div>
            </label>
            <label class="checkbox">
                <input type="checkbox" name="remember"> Ingat saya
            </label>
            <button class="btn btn-primary btn-block">Masuk</button>
            <a href="{{ route('home') }}" class="back-link"><x-icon name="chevron-left" size="16" /> Kembali ke website</a>
        </form>
    </div>
</body>
</html>

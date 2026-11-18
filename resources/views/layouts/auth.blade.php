<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Kirish — Olmacha o‘quv markazi')</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="alternate icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
</head>
<body class="auth-body">
<div class="auth-shell">
    <aside class="auth-visual">
        <a href="{{ route('home') }}" class="brand brand-light">
            <span class="brand-mark">O</span>
            <span class="brand-text"><strong>Olmacha</strong><small>o‘quv markazi</small></span>
        </a>

        <div class="auth-visual-inner">
            <h2>Bilim sari birinchi qadam</h2>
            <p>Shaxsiy kabinetda guruh jadvali, davomat va to‘lovlar tarixini bir joyda kuzatib boring.</p>
            <ul class="auth-points">
                <li>Guruh jadvali va dars mavzulari</li>
                <li>Davomat va natijalar tarixi</li>
                <li>To‘lovlar bo‘yicha hisobot</li>
            </ul>
        </div>

        <span class="auth-foot">© {{ date('Y') }} Olmacha o‘quv markazi</span>
    </aside>

    <main class="auth-panel">
        <div class="auth-card">
            <div class="container flash-slot">
                @include('partials.flash')
            </div>
            @yield('content')
        </div>
    </main>
</div>
</body>
</html>

<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', "Olmacha o'quv markazi — bilim sari birinchi qadam")</title>
    <meta name="description" content="@yield('meta', "Olmacha o'quv markazi: IELTS, matematika, IT va dizayn kurslari. Kichik guruhlar, tajribali o'qituvchilar va zamonaviy o'quv platformasi.")">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="alternate icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
</head>
<body>
<header class="site-header">
    <div class="container header-inner">
        <input type="checkbox" id="nav-toggle" class="nav-toggle-input">

        <a href="{{ route('home') }}" class="brand">
            <span class="brand-mark">O</span>
            <span class="brand-text"><strong>Olmacha</strong><small>o‘quv markazi</small></span>
        </a>

        <nav class="site-nav">
            <a class="nav-link {{ request()->routeIs('home') ? 'is-active' : '' }}" href="{{ route('home') }}">Bosh sahifa</a>
            <a class="nav-link {{ request()->routeIs('courses.*') ? 'is-active' : '' }}" href="{{ route('courses.index') }}">Kurslar</a>
            <a class="nav-link {{ request()->routeIs('teachers.*') ? 'is-active' : '' }}" href="{{ route('teachers.index') }}">O‘qituvchilar</a>
            <a class="nav-link {{ request()->routeIs('about') ? 'is-active' : '' }}" href="{{ route('about') }}">Markaz haqida</a>
            <a class="nav-link {{ request()->routeIs('contact') ? 'is-active' : '' }}" href="{{ route('contact') }}">Aloqa</a>
        </nav>

        <div class="header-actions">
            @auth
                <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('cabinet.dashboard') }}" class="btn btn-ghost">Kabinet</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-ghost">Kirish</a>
            @endauth
            <a href="{{ route('contact') }}" class="btn btn-primary">
                <span class="cta-label-full">Ariza qoldirish</span>
                <span class="cta-label-short">Ariza</span>
            </a>
        </div>

        <label for="nav-toggle" class="nav-toggle" aria-label="Menyuni ochish">
            <span></span><span></span><span></span>
        </label>
    </div>
</header>

<main>
    <div class="container flash-slot">
        @include('partials.flash')
    </div>
    @yield('content')
</main>

<footer class="site-footer">
    <div class="container footer-grid">
        <div class="footer-brand">
            <a href="{{ route('home') }}" class="brand brand-light">
                <span class="brand-mark">O</span>
                <span class="brand-text"><strong>Olmacha</strong><small>o‘quv markazi</small></span>
            </a>
            <p>2014-yildan buyon o‘quvchilarni bilim va kasb sari tayyorlaymiz. Kichik guruhlar, amaliyotga asoslangan dasturlar va individual yondashuv.</p>
        </div>

        <div class="footer-col">
            <h4>Kurslar</h4>
            <a href="{{ route('courses.index') }}">Barcha kurslar</a>
            <a href="{{ route('courses.index', ['kategoriya' => 'Chet tillari']) }}">Chet tillari</a>
            <a href="{{ route('courses.index', ['kategoriya' => 'IT']) }}">IT va dizayn</a>
            <a href="{{ route('courses.index', ['kategoriya' => 'Aniq fanlar']) }}">Aniq fanlar</a>
        </div>

        <div class="footer-col">
            <h4>Markaz</h4>
            <a href="{{ route('about') }}">Biz haqimizda</a>
            <a href="{{ route('teachers.index') }}">O‘qituvchilar</a>
            <a href="{{ route('contact') }}">Aloqa</a>
            <a href="{{ route('login') }}">Talaba kabineti</a>
        </div>

        <div class="footer-col">
            <h4>Bog‘lanish</h4>
            <p>+998 90 123 45 67</p>
            <p>info@olmacha.uz</p>
            <p>Toshkent, Chilonzor 19-kvartal, 42-uy</p>
            <p>Du–Sha: 08:00 – 20:00</p>
        </div>
    </div>

    <div class="container footer-bottom">
        <span>© {{ date('Y') }} Olmacha o‘quv markazi. Barcha huquqlar himoyalangan.</span>
        <span>Bilim — eng yaxshi investitsiya.</span>
    </div>
</footer>
</body>
</html>

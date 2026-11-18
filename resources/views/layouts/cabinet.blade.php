<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Talaba kabineti') — Olmacha</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="alternate icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('css/panel.css') }}">
</head>
<body class="panel-body">
<div class="panel-shell">
    <aside class="panel-sidebar">
        <a href="{{ route('home') }}" class="panel-brand">
            <span class="brand-mark">O</span>
            <span class="brand-text"><strong>Olmacha</strong><small>talaba kabineti</small></span>
        </a>

        <nav class="panel-nav">
            <a href="{{ route('cabinet.dashboard') }}" class="panel-nav-link {{ request()->routeIs('cabinet.dashboard') ? 'is-active' : '' }}">Bosh sahifa</a>
            <a href="{{ route('cabinet.dashboard') }}#guruhlar" class="panel-nav-link">Guruhlarim</a>
            <a href="{{ route('cabinet.payments') }}" class="panel-nav-link {{ request()->routeIs('cabinet.payments') ? 'is-active' : '' }}">To‘lovlar</a>
            <a href="{{ route('home') }}" class="panel-nav-link">Saytga qaytish</a>
        </nav>

        <div class="panel-sidebar-foot">
            <div class="panel-user">
                <span class="panel-avatar">{{ auth()->user()->initials() }}</span>
                <div>
                    <strong>{{ auth()->user()->name }}</strong>
                    <span>Talaba</span>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="panel-logout">Chiqish</button>
            </form>
        </div>
    </aside>

    <main class="panel-main">
        <header class="panel-topbar">
            <div>
                <span class="panel-kicker">@yield('kicker', 'Talaba kabineti')</span>
                <h1 class="panel-title">@yield('header', 'Bosh sahifa')</h1>
            </div>
            <a href="{{ route('courses.index') }}" class="btn btn-soft btn-sm">Kurslar</a>
        </header>

        <div class="panel-content">
            @include('partials.flash')
            @yield('content')
        </div>
    </main>
</div>
</body>
</html>

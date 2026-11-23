<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin panel') — Olmacha</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="alternate icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('css/panel.css') }}">
</head>
<body class="panel-body">
<div class="panel-shell">
    <aside class="panel-sidebar">
        <a href="{{ route('admin.dashboard') }}" class="panel-brand">
            <span class="brand-mark">O</span>
            <span class="brand-text"><strong>Olmacha</strong><small>admin panel</small></span>
        </a>

        <nav class="panel-nav">
            <a href="{{ route('admin.dashboard') }}" class="panel-nav-link {{ request()->routeIs('admin.dashboard') ? 'is-active' : '' }}">Dashboard</a>
            <a href="{{ route('admin.courses.index') }}" class="panel-nav-link {{ request()->routeIs('admin.courses.*') ? 'is-active' : '' }}">Kurslar</a>
            <a href="{{ route('admin.teachers.index') }}" class="panel-nav-link {{ request()->routeIs('admin.teachers.*') ? 'is-active' : '' }}">O‘qituvchilar</a>
            <a href="{{ route('admin.groups.index') }}" class="panel-nav-link {{ request()->routeIs('admin.groups.*') || request()->routeIs('admin.lessons.*') ? 'is-active' : '' }}">Guruhlar</a>
            <a href="{{ route('admin.students.index') }}" class="panel-nav-link {{ request()->routeIs('admin.students.*') ? 'is-active' : '' }}">Talabalar</a>
            <a href="{{ route('admin.applications.index') }}" class="panel-nav-link {{ request()->routeIs('admin.applications.*') ? 'is-active' : '' }}">Arizalar</a>
            <a href="{{ route('admin.payments.index') }}" class="panel-nav-link {{ request()->routeIs('admin.payments.*') ? 'is-active' : '' }}">To‘lovlar</a>
            <a href="{{ route('admin.password.edit') }}" class="panel-nav-link {{ request()->routeIs('admin.password.*') ? 'is-active' : '' }}">Parol</a>
        </nav>

        <div class="panel-sidebar-foot">
            <div class="panel-user">
                <span class="panel-avatar">{{ auth()->user()->initials() }}</span>
                <div>
                    <strong>{{ auth()->user()->name }}</strong>
                    <span>Administrator</span>
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
                <span class="panel-kicker">@yield('kicker', 'Boshqaruv')</span>
                <h1 class="panel-title">@yield('header', 'Dashboard')</h1>
            </div>
            <div class="panel-actions">
                @yield('actions')
                <a href="{{ route('home') }}" class="btn btn-ghost btn-sm">Sayt</a>
            </div>
        </header>

        <div class="panel-content">
            @include('partials.flash')
            @yield('content')
        </div>
    </main>
</div>
</body>
</html>

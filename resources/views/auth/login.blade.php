@extends('layouts.auth')

@section('title', 'Kirish — Olmacha o‘quv markazi')

@section('content')
<h1 class="auth-title">Tizimga kirish</h1>
<p class="auth-sub">Talaba kabineti yoki administrator paneliga kirish uchun email va parolingizni kiriting.</p>

<form method="POST" action="{{ route('login.store') }}" class="auth-form">
    @csrf

    <div class="field">
        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="siz@example.com">
    </div>

    <div class="field">
        <label for="password">Parol</label>
        <input id="password" type="password" name="password" required placeholder="••••••••">
    </div>

    <label class="checkbox">
        <input type="checkbox" name="remember" value="1">
        <span>Eslab qolish</span>
    </label>

    <button type="submit" class="btn btn-primary btn-block">Kirish</button>
</form>

<p class="auth-switch">Hisobingiz yo‘qmi? <a href="{{ route('register') }}">Ro‘yxatdan o‘tish</a></p>

<div class="auth-hint">
    <strong>Demo hisoblar:</strong><br>
    Administrator — admin@olmacha.uz / admin123<br>
    Talaba — talaba@olmacha.uz / talaba123
</div>
@endsection

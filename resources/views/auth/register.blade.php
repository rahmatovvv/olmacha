@extends('layouts.auth')

@section('title', 'Ro‘yxatdan o‘tish — Olmacha o‘quv markazi')

@section('content')
<h1 class="auth-title">Ro‘yxatdan o‘tish</h1>
<p class="auth-sub">Kabinet yaratib, guruhlar va davomatni onlayn kuzatishni boshlang.</p>

<form method="POST" action="{{ route('register.store') }}" class="auth-form">
    @csrf

    <div class="field">
        <label for="name">Ism va familiya</label>
        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="Malika Yusupova">
    </div>

    <div class="field">
        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required placeholder="siz@example.com">
    </div>

    <div class="field">
        <label for="phone">Telefon raqam</label>
        <input id="phone" type="text" name="phone" value="{{ old('phone') }}" placeholder="+998 90 123 45 67">
    </div>

    <div class="field">
        <label for="password">Parol</label>
        <input id="password" type="password" name="password" required placeholder="Kamida 8 belgi">
    </div>

    <div class="field">
        <label for="password_confirmation">Parolni tasdiqlash</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required>
    </div>

    <button type="submit" class="btn btn-primary btn-block">Ro‘yxatdan o‘tish</button>
</form>

<p class="auth-switch">Hisobingiz bormi? <a href="{{ route('login') }}">Kirish</a></p>
@endsection

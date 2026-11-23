@extends('layouts.admin')

@section('title', 'Parolni almashtirish')
@section('kicker', 'Profil')
@section('header', 'Parolni almashtirish')

@section('content')
<section class="card form-card">
    <form method="POST" action="{{ route('admin.password.update') }}">
        @csrf
        @method('PUT')

        <div class="form-grid">
            <div class="field field-full">
                <label for="current_password">Joriy parol *</label>
                <input id="current_password" type="password" name="current_password" required autocomplete="current-password">
            </div>

            <div class="field">
                <label for="password">Yangi parol *</label>
                <input id="password" type="password" name="password" required autocomplete="new-password">
                <small>Kamida 8 belgi, joriy paroldan farq qilsin.</small>
            </div>

            <div class="field">
                <label for="password_confirmation">Yangi parol (takror) *</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Parolni saqlash</button>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-ghost">Bekor qilish</a>
        </div>
    </form>
</section>
@endsection

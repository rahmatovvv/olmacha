@extends('layouts.site')

@section('title', "Aloqa — Olmacha o'quv markazi")

@section('content')
<section class="page-hero">
    <div class="container">
        <span class="eyebrow">Aloqa</span>
        <h1>Biz bilan bog‘laning</h1>
        <p class="page-lead">Savolingiz bo‘lsa qo‘ng‘iroq qiling yoki ariza qoldiring — administratorlarimiz ish vaqtida javob beradi.</p>
    </div>
</section>

<section class="section">
    <div class="container contact-grid">
        <div class="contact-info">
            <div class="contact-card">
                <span class="contact-label">Telefon</span>
                <a href="tel:+998901234567" class="contact-value">+998 90 123 45 67</a>
                <span class="contact-note">Du–Sha, 08:00 – 20:00</span>
            </div>
            <div class="contact-card">
                <span class="contact-label">Email</span>
                <a href="mailto:info@olmacha.uz" class="contact-value">info@olmacha.uz</a>
                <span class="contact-note">24 soat ichida javob beramiz</span>
            </div>
            <div class="contact-card">
                <span class="contact-label">Manzil</span>
                <span class="contact-value">Toshkent, Chilonzor 19-kvartal, 42-uy</span>
                <span class="contact-note">Metro: Chilonzor, 5 daqiqa piyoda</span>
            </div>
            <div class="contact-card contact-card-accent">
                <span class="contact-label">Bepul sinov darsi</span>
                <span class="contact-value">Har kuni 10:00 – 18:00</span>
                <span class="contact-note">Ariza qoldiring, vaqtni birga tanlaymiz</span>
            </div>
        </div>

        <div class="apply-card apply-card-large">
            <h2 class="form-title">Ariza / savol yuborish</h2>
            @include('site.partials.apply-form', ['courses' => $courses])
        </div>
    </div>
</section>
@endsection

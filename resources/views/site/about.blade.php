@extends('layouts.site')

@section('title', "Markaz haqida — Olmacha o'quv markazi")

@section('content')
<section class="page-hero">
    <div class="container">
        <span class="eyebrow">Biz haqimizda</span>
        <h1>2014-yildan buyon bilim sari</h1>
        <p class="page-lead">Olmacha — kichik guruhlarda sifatli ta’lim berish g‘oyasi bilan boshlangan o‘quv markazi. Bugun {{ $courseCount }} yo‘nalishda darslar olib boriladi.</p>
    </div>
</section>

<section class="section">
    <div class="container about-grid">
        <div class="about-copy">
            <h2 class="detail-title">Bizning tariximiz</h2>
            <div class="prose">
                <p>Markaz 2014-yilda bitta ingliz tili xonasidan boshlangan. Talabalar soni oshgani sari matematika, IT va dizayn yo‘nalishlari qo‘shildi. Bugun Olmacha — o‘z jadvali, shaxsiy kabineti va ichki nazorat tizimi bo‘lgan to‘laqonli o‘quv markazi.</p>
                <p>Asosiy tamoyilimiz oddiy: har bir talaba darsdan aniq natija bilan chiqishi kerak. Shuning uchun guruhlar kichik, dasturlar amaliyotga asoslangan va har hafta nazorat ishi o‘tkaziladi.</p>
            </div>

            <h2 class="detail-title">Qadriyatlarimiz</h2>
            <ul class="value-list">
                <li><strong>Sifat birinchi o‘rinda.</strong> Yangi o‘qituvchi faqat sinov darslaridan keyin guruhga qo‘yiladi.</li>
                <li><strong>Ochiq muloqot.</strong> Ota-onalar davomat va natijalarni onlayn kuzatadi.</li>
                <li><strong>Individual yondashuv.</strong> Har bir talabaning kuchli va zaif tomonlari bo‘yicha tavsiyalar beriladi.</li>
                <li><strong>Amaliyot.</strong> IT va dizayn kurslarida nazariyadan ko‘ra loyiha ustida ishlash ustuvor.</li>
            </ul>
        </div>

        <aside class="about-side">
            <div class="sticky-card">
                <h3 class="form-title">Raqamlarda Olmacha</h3>
                <div class="spec-list">
                    <div class="spec-row"><span>Tashkil etilgan</span><strong>2014-yil</strong></div>
                    <div class="spec-row"><span>Yo‘nalishlar</span><strong>{{ $courseCount }} ta</strong></div>
                    <div class="spec-row"><span>Guruhdagi talaba</span><strong>10–12</strong></div>
                    <div class="spec-row"><span>O‘qish kunlari</span><strong>Du–Sha</strong></div>
                    <div class="spec-row"><span>Ish vaqti</span><strong>08:00 – 20:00</strong></div>
                </div>
                <a href="{{ route('contact') }}" class="btn btn-primary btn-block">Bepul maslahat olish</a>
            </div>
        </aside>
    </div>
</section>

<section class="section section-tint">
    <div class="container">
        <div class="section-head">
            <div>
                <span class="eyebrow eyebrow-dark">Jamoa</span>
                <h2 class="section-title">Tajribali o‘qituvchilar</h2>
            </div>
            <a href="{{ route('teachers.index') }}" class="section-link">Barchasi →</a>
        </div>

        <div class="teacher-grid">
            @foreach ($teachers as $teacher)
                <article class="teacher-card">
                    <span class="avatar">{{ $teacher->initials() }}</span>
                    <h3>{{ $teacher->name }}</h3>
                    <span class="teacher-spec">{{ $teacher->specialty }}</span>
                    <p class="teacher-bio">{{ \Illuminate\Support\Str::limit($teacher->bio, 150) }}</p>
                    <span class="teacher-exp">{{ $teacher->experience_years }} yillik tajriba</span>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endsection

@extends('layouts.site')

@section('title', "O'qituvchilar — Olmacha o'quv markazi")

@section('content')
<section class="page-hero">
    <div class="container">
        <span class="eyebrow">Jamoa</span>
        <h1>O‘qituvchilar</h1>
        <p class="page-lead">Har bir yo‘nalishda amaliyotchi mutaxassislar. Kichik guruhlar sababli har bir talabaga vaqt yetarli.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="teacher-grid teacher-grid-wide">
            @foreach ($teachers as $teacher)
                <article class="teacher-card">
                    <span class="avatar">{{ $teacher->initials() }}</span>
                    <h3>{{ $teacher->name }}</h3>
                    <span class="teacher-spec">{{ $teacher->specialty }}</span>
                    <p class="teacher-bio">{{ $teacher->bio }}</p>
                    <div class="teacher-foot">
                        <span class="teacher-exp">{{ $teacher->experience_years }} yillik tajriba</span>
                        <span class="teacher-groups">{{ $teacher->groups_count }} guruh</span>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="cta-band">
    <div class="container cta-inner">
        <div class="cta-copy">
            <span class="eyebrow">Savol bormi?</span>
            <h2>O‘qituvchi bilan tanishishni xohlaysizmi?</h2>
            <p>Bepul sinov darsiga yoziling — darsdan keyin guruh va yo‘nalish bo‘yicha qaror qabul qilasiz.</p>
        </div>
        <div class="apply-card">
            <h3>Ariza formasi</h3>
            @include('site.partials.apply-form', ['courses' => \App\Models\Course::active()->orderBy('title')->get()])
        </div>
    </div>
</section>
@endsection

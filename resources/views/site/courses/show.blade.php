@extends('layouts.site')

@section('title', $course->title.' — Olmacha o\'quv markazi')
@section('meta', $course->summary)

@section('content')
<section class="page-hero">
    <div class="container">
        <div class="breadcrumbs">
            <a href="{{ route('home') }}">Bosh sahifa</a>
            <span>/</span>
            <a href="{{ route('courses.index') }}">Kurslar</a>
            <span>/</span>
            <span>{{ $course->title }}</span>
        </div>
        <span class="chip">{{ $course->category }}</span>
        <h1>{{ $course->title }}</h1>
        <p class="page-lead">{{ $course->summary }}</p>
        <div class="course-meta course-meta-light">
            <span>{{ $course->duration_months }} oy</span>
            <span>Haftada {{ $course->lessons_per_week }} dars</span>
            <span>{{ $course->level }}</span>
        </div>
    </div>
</section>

<section class="section">
    <div class="container detail-grid">
        <div class="detail-main">
            <h2 class="detail-title">Kurs haqida</h2>
            <div class="prose">{!! nl2br(e($course->description)) !!}</div>

            @if ($course->syllabusLines())
                <h2 class="detail-title">Kurs dasturi</h2>
                <ol class="syllabus">
                    @foreach ($course->syllabusLines() as $line)
                        <li>{{ $line }}</li>
                    @endforeach
                </ol>
            @endif

            <h2 class="detail-title">Guruhlar va jadval</h2>
            @if ($groups->isEmpty())
                <p class="empty">Bu kurs bo‘yicha yangi guruhlar tez orada e’lon qilinadi. Ariza qoldiring — sizga birinchi bo‘lib xabar beramiz.</p>
            @else
                <div class="group-list">
                    @foreach ($groups as $group)
                        <div class="group-row">
                            <div class="group-main">
                                <h3>{{ $group->name }}</h3>
                                <p>{{ $group->teacher?->name ?? 'O‘qituvchi tayinlanadi' }} · {{ $group->room }}</p>
                            </div>
                            <div class="group-side">
                                <span class="group-date">{{ $group->starts_at->format('d.m.Y') }}</span>
                                <span class="group-schedule">{{ $group->schedule }}</span>
                            </div>
                            <div class="group-seats">
                                <strong>{{ $group->seatsLeft() }}</strong>
                                <span>bo‘sh joy</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <aside class="detail-side">
            <div class="sticky-card">
                <div class="price-block">
                    <span class="price">{{ number_format($course->price, 0, '.', ' ') }} <small>so‘m / oy</small></span>
                    <span class="chip chip-accent">Bepul sinov darsi</span>
                </div>

                <div class="spec-list">
                    <div class="spec-row"><span>Davomiyligi</span><strong>{{ $course->duration_months }} oy</strong></div>
                    <div class="spec-row"><span>Darslar</span><strong>Haftada {{ $course->lessons_per_week }} marta</strong></div>
                    <div class="spec-row"><span>Daraja</span><strong>{{ $course->level }}</strong></div>
                    <div class="spec-row"><span>Guruh</span><strong>10–12 talaba</strong></div>
                </div>

                <h3 class="form-title">Ariza qoldirish</h3>
                @include('site.partials.apply-form', ['course' => $course])
            </div>
        </aside>
    </div>
</section>

@if ($related->isNotEmpty())
    <section class="section section-tint">
        <div class="container">
            <div class="section-head">
                <div>
                    <span class="eyebrow eyebrow-dark">O‘xshash</span>
                    <h2 class="section-title">Boshqa kurslar</h2>
                </div>
                <a href="{{ route('courses.index') }}" class="section-link">Barchasi →</a>
            </div>
            <div class="course-grid">
                @foreach ($related as $item)
                    <article class="course-card">
                        <div class="course-card-head"><span class="chip">{{ $item->category }}</span></div>
                        <h3 class="course-title"><a href="{{ route('courses.show', $item) }}">{{ $item->title }}</a></h3>
                        <p class="course-summary">{{ $item->summary }}</p>
                        <div class="course-foot">
                            <span class="price">{{ number_format($item->price, 0, '.', ' ') }} <small>so‘m/oy</small></span>
                            <a href="{{ route('courses.show', $item) }}" class="btn btn-soft btn-sm">Batafsil</a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endif
@endsection

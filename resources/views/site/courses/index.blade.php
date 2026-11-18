@extends('layouts.site')

@section('title', "Kurslar — Olmacha o'quv markazi")

@section('content')
<section class="page-hero">
    <div class="container">
        <span class="eyebrow">Yo‘nalishlar</span>
        <h1>Barcha kurslar</h1>
        <p class="page-lead">Til, aniq fanlar, IT va dizayn yo‘nalishlari. Har bir kurs uchun guruhlar jadvali va narxlar ochiq ko‘rsatilgan.</p>

        <form method="GET" action="{{ route('courses.index') }}" class="catalog-filter">
            <input type="text" name="q" value="{{ $search }}" placeholder="Kurs nomi bo‘yicha qidirish">
            <button type="submit" class="btn btn-light">Qidirish</button>
        </form>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="filter-chips">
            <a href="{{ route('courses.index') }}" class="chip {{ $category === '' ? 'is-active' : '' }}">Barchasi</a>
            @foreach ($categories as $item)
                <a href="{{ route('courses.index', ['kategoriya' => $item]) }}" class="chip {{ $category === $item ? 'is-active' : '' }}">{{ $item }}</a>
            @endforeach
        </div>

        @if ($courses->isEmpty())
            <p class="empty">Hech narsa topilmadi. Boshqa so‘z bilan qidirib ko‘ring.</p>
        @else
            <div class="course-grid">
                @foreach ($courses as $course)
                    <article class="course-card">
                        <div class="course-card-head">
                            <span class="chip">{{ $course->category }}</span>
                            @if ($course->is_featured)
                                <span class="chip chip-accent">Top tanlov</span>
                            @endif
                        </div>
                        <h3 class="course-title"><a href="{{ route('courses.show', $course) }}">{{ $course->title }}</a></h3>
                        <p class="course-summary">{{ $course->summary }}</p>
                        <div class="course-meta">
                            <span>{{ $course->duration_months }} oy</span>
                            <span>Haftada {{ $course->lessons_per_week }} dars</span>
                            <span>{{ $course->level }}</span>
                        </div>
                        <div class="course-foot">
                            <span class="price">{{ number_format($course->price, 0, '.', ' ') }} <small>so‘m/oy</small></span>
                            <a href="{{ route('courses.show', $course) }}" class="btn btn-soft btn-sm">Batafsil</a>
                        </div>
                    </article>
                @endforeach
            </div>

            {{ $courses->links('pagination.simple') }}
        @endif
    </div>
</section>
@endsection

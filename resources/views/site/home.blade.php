@extends('layouts.site')

@section('title', "Olmacha o'quv markazi — IELTS, matematika, IT kurslari")

@section('content')
<section class="hero">
    <div class="hero-glow" aria-hidden="true"></div>
    <div class="container hero-inner">
        <div class="hero-copy">
            <span class="eyebrow">2014-yildan buyon Toshkentda</span>
            <h1 class="hero-title">Bilim — kelajagingizga qo‘yilgan eng foydali investitsiya</h1>
            <p class="hero-lead">
                IELTS, matematika, dasturlash va dizayn yo‘nalishlarida kichik guruhlarda o‘qing.
                Tajribali o‘qituvchilar, shaxsiy kabinet va natijaga yo‘naltirilgan dasturlar.
            </p>
            <div class="hero-actions">
                <a href="{{ route('courses.index') }}" class="btn btn-light">Kurslarni ko‘rish</a>
                <a href="{{ route('contact') }}" class="btn btn-outline-light">Bepul maslahat</a>
            </div>
            <div class="hero-points">
                <span>✓ Guruhda 10–12 talaba</span>
                <span>✓ Haftada 2–3 dars</span>
                <span>✓ Onlayn kabinet</span>
            </div>
        </div>

        <aside class="hero-panel">
            <div class="panel-head">
                <span>Yangi guruhlar</span>
                <span class="panel-badge">Qabul ochiq</span>
            </div>
            @forelse ($upcomingGroups as $group)
                <a href="{{ route('courses.show', $group->course) }}" class="panel-item">
                    <div>
                        <strong>{{ $group->course->title }}</strong>
                        <span>{{ $group->schedule }} · {{ $group->starts_at->format('d.m.Y') }}</span>
                    </div>
                    <span class="panel-seats">{{ max(0, $group->capacity - $group->enrollments_count) }} joy</span>
                </a>
            @empty
                <p class="panel-empty">Hozircha guruhlar shakllanmoqda.</p>
            @endforelse
            <a href="{{ route('contact') }}" class="btn btn-light btn-block">Guruhga yozilish</a>
        </aside>
    </div>
</section>

<section class="stats-band">
    <div class="container stats-grid">
        <div class="stat"><span class="stat-value">{{ $stats['students'] }}+</span><span class="stat-label">Faol talaba</span></div>
        <div class="stat"><span class="stat-value">{{ $stats['courses'] }}</span><span class="stat-label">Yo‘nalish</span></div>
        <div class="stat"><span class="stat-value">{{ $stats['teachers'] }}</span><span class="stat-label">O‘qituvchi</span></div>
        <div class="stat"><span class="stat-value">{{ $stats['years'] }} yil</span><span class="stat-label">Tajriba</span></div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-head">
            <div>
                <span class="eyebrow eyebrow-dark">Yo‘nalishlar</span>
                <h2 class="section-title">O‘zingizga mos kursni tanlang</h2>
                <p class="section-lead">Har bir kurs amaliyotga asoslangan: nazariya, mashq va nazorat birga olib boriladi.</p>
            </div>
            <a href="{{ route('courses.index') }}" class="section-link">Barcha kurslar →</a>
        </div>

        <div class="course-grid">
            @foreach ($featuredCourses as $course)
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
    </div>
</section>

<section class="section section-tint">
    <div class="container">
        <div class="section-head">
            <div>
                <span class="eyebrow eyebrow-dark">Nega Olmacha?</span>
                <h2 class="section-title">Natija uchun qurilgan o‘quv jarayoni</h2>
            </div>
        </div>

        <div class="feature-grid">
            <div class="feature">
                <span class="feature-icon">01</span>
                <h3>Kichik guruhlar</h3>
                <p>Har bir guruhda 10–12 talaba. O‘qituvchi har bir o‘quvchining gapirish va yozish amaliyotini kuzatib boradi.</p>
            </div>
            <div class="feature">
                <span class="feature-icon">02</span>
                <h3>Amaliyot birinchi o‘rinda</h3>
                <p>Har darsda mashqlar, har hafta nazorat ishi. IT kurslarida esa real loyihalar ustida ishlanadi.</p>
            </div>
            <div class="feature">
                <span class="feature-icon">03</span>
                <h3>Talaba kabineti</h3>
                <p>Jadval, davomat va to‘lovlar tarixi shaxsiy kabinetda. Har bir darsdan keyin natija ko‘rinadi.</p>
            </div>
            <div class="feature">
                <span class="feature-icon">04</span>
                <h3>Ochiq muloqot</h3>
                <p>Ota-onalar va talabalar uchun ochiq aloqa liniyasi. Har oy natijalar bo‘yicha hisobot beriladi.</p>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-head">
            <div>
                <span class="eyebrow eyebrow-dark">Jadval</span>
                <h2 class="section-title">Yaqin orada boshlanadigan guruhlar</h2>
                <p class="section-lead">Guruhlar to‘lib boradi — joyni oldindan band qilishni tavsiya qilamiz.</p>
            </div>
            <a href="{{ route('courses.index') }}" class="section-link">Kurslar bo‘yicha →</a>
        </div>

        <div class="group-list">
            @foreach ($upcomingGroups as $group)
                <div class="group-row">
                    <div class="group-main">
                        <span class="chip">{{ $group->course->category }}</span>
                        <h3>{{ $group->course->title }}</h3>
                        <p>{{ $group->name }} · {{ $group->teacher?->name ?? 'O‘qituvchi tayinlanadi' }} · {{ $group->room }}</p>
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
    </div>
</section>

<section class="section section-tint">
    <div class="container">
        <div class="section-head">
            <div>
                <span class="eyebrow eyebrow-dark">Jamoa</span>
                <h2 class="section-title">O‘qituvchilar</h2>
                <p class="section-lead">Har bir yo‘nalish bo‘yicha amaliyotchi mutaxassislar dars beradi.</p>
            </div>
            <a href="{{ route('teachers.index') }}" class="section-link">Butun jamoa →</a>
        </div>

        <div class="teacher-grid">
            @foreach ($teachers as $teacher)
                <article class="teacher-card">
                    <span class="avatar">{{ $teacher->initials() }}</span>
                    <h3>{{ $teacher->name }}</h3>
                    <span class="teacher-spec">{{ $teacher->specialty }}</span>
                    <p class="teacher-bio">{{ \Illuminate\Support\Str::limit($teacher->bio, 140) }}</p>
                    <span class="teacher-exp">{{ $teacher->experience_years }} yillik tajriba</span>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-head">
            <div>
                <span class="eyebrow eyebrow-dark">Fikrlar</span>
                <h2 class="section-title">Talabalarimiz nima deydi</h2>
            </div>
        </div>

        <div class="quote-grid">
            <figure class="quote">
                <p class="quote-text">“IELTS kursini 5 oyda tugatib, 7.0 oldim. Har hafta mock test bo‘lishi va yozish ishlarini birma-bir tekshirishlari juda yordam berdi.”</p>
                <figcaption class="quote-author"><strong>Malika Y.</strong><span>IELTS 7.0</span></figcaption>
            </figure>
            <figure class="quote">
                <p class="quote-text">“Matematikadan qo‘rqardim, hozir DTM testlarini bemalol yechaman. Ustoz har mavzuni hayotiy misollar bilan tushuntiradi.”</p>
                <figcaption class="quote-author"><strong>Islom R.</strong><span>DTM talabasi</span></figcaption>
            </figure>
            <figure class="quote">
                <p class="quote-text">“Web kursida 3 ta loyiha qildik. Hozir junior dasturchi bo‘lib ishlayapman — bilimlarim amaliyotda to‘liq kerak bo‘ldi.”</p>
                <figcaption class="quote-author"><strong>Diyora S.</strong><span>Web dasturchi</span></figcaption>
            </figure>
        </div>
    </div>
</section>

<section class="cta-band">
    <div class="container cta-inner">
        <div class="cta-copy">
            <span class="eyebrow">Birinchi qadam</span>
            <h2>Bepul sinov darsiga yoziling</h2>
            <p>Ariza qoldiring — administratorlarimiz qulay vaqtni tanlab, guruh va daraja bo‘yicha maslahat beradi.</p>
            <div class="cta-contacts">
                <a href="tel:+998901234567">+998 90 123 45 67</a>
                <span>Toshkent, Chilonzor 19-kvartal, 42-uy</span>
            </div>
        </div>
        <div class="apply-card">
            <h3>Ariza formasi</h3>
            @include('site.partials.apply-form', ['courses' => $featuredCourses])
        </div>
    </div>
</section>
@endsection

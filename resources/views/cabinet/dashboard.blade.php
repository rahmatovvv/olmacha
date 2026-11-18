@extends('layouts.cabinet')

@section('title', 'Bosh sahifa')
@section('header', 'Salom, '.auth()->user()->name)
@section('kicker', 'Bugungi holat')

@section('content')
<div class="stat-grid">
    <div class="stat-card">
        <span class="stat-card-label">Faol guruhlar</span>
        <span class="stat-card-value">{{ $enrollments->where('status', 'active')->count() }}</span>
        <span class="stat-card-note">o‘qiyotgan guruhlaringiz</span>
    </div>
    <div class="stat-card">
        <span class="stat-card-label">Davomat</span>
        <span class="stat-card-value">{{ $attendanceRate }}%</span>
        <span class="stat-card-note">{{ $presentCount }} / {{ $totalLessons }} dars</span>
    </div>
    <div class="stat-card">
        <span class="stat-card-label">Jami to‘langan</span>
        <span class="stat-card-value">{{ number_format($totalPaid, 0, '.', ' ') }}</span>
        <span class="stat-card-note">so‘m</span>
    </div>
    <div class="stat-card">
        <span class="stat-card-label">Oxirgi to‘lov</span>
        <span class="stat-card-value">{{ $lastPayment ? $lastPayment->paid_at->format('d.m.Y') : '—' }}</span>
        <span class="stat-card-note">{{ $lastPayment ? number_format($lastPayment->amount, 0, '.', ' ').' so‘m' : 'to‘lov yo‘q' }}</span>
    </div>
</div>

<div class="panel-columns">
    <section class="card" id="guruhlar">
        <div class="card-head">
            <h2>Mening guruhlarim</h2>
            <span class="muted">Jadval va davomat</span>
        </div>

        @if ($enrollments->isEmpty())
            <p class="empty">Hozircha guruhga yozilmagansiz. <a href="{{ route('courses.index') }}">Kurslarni ko‘ring</a> yoki administrator bilan bog‘laning.</p>
        @else
            <div class="stack">
                @foreach ($enrollments as $enrollment)
                    @php($group = $enrollment->studyGroup)
                    <a href="{{ route('cabinet.group', $group) }}" class="list-card">
                        <div>
                            <span class="chip">{{ $group->course->category }}</span>
                            <h3>{{ $group->course->title }}</h3>
                            <p>{{ $group->name }} · {{ $group->teacher?->name ?? 'O‘qituvchi tayinlanadi' }}</p>
                        </div>
                        <div class="list-card-side">
                            <strong>{{ $group->schedule }}</strong>
                            <span>{{ $group->room }}</span>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </section>

    <section class="card">
        <div class="card-head">
            <h2>Yaqin darslar</h2>
            <span class="muted">Keyingi 5 dars</span>
        </div>

        @if ($nextLessons->isEmpty())
            <p class="empty">Yaqin kunlarda rejalashtirilgan dars yo‘q.</p>
        @else
            <div class="timeline">
                @foreach ($nextLessons as $lesson)
                    <div class="timeline-item">
                        <span class="timeline-date">{{ $lesson->starts_at->format('d.m') }}<small>{{ $lesson->starts_at->format('H:i') }}</small></span>
                        <div>
                            <strong>{{ $lesson->topic ?? $lesson->title }}</strong>
                            <span>{{ $lesson->studyGroup->course->title }} · {{ $lesson->studyGroup->name }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </section>
</div>
@endsection

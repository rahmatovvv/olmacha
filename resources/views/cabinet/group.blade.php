@extends('layouts.cabinet')

@section('title', $group->name)
@section('kicker', $group->course->title)
@section('header', $group->name)

@section('content')
<a href="{{ route('cabinet.dashboard') }}" class="back-link">← Kabinetga qaytish</a>

<div class="stat-grid">
    <div class="stat-card">
        <span class="stat-card-label">Davomat</span>
        <span class="stat-card-value">{{ $attendanceRate }}%</span>
        <span class="stat-card-note">{{ $attended }} darsda qatnashgan</span>
    </div>
    <div class="stat-card">
        <span class="stat-card-label">O‘qituvchi</span>
        <span class="stat-card-value stat-card-value-sm">{{ $group->teacher?->name ?? 'Tayinlanadi' }}</span>
        <span class="stat-card-note">{{ $group->teacher?->specialty }}</span>
    </div>
    <div class="stat-card">
        <span class="stat-card-label">Jadval</span>
        <span class="stat-card-value stat-card-value-sm">{{ $group->schedule }}</span>
        <span class="stat-card-note">{{ $group->room }} · {{ $group->course->duration_months }} oy</span>
    </div>
    <div class="stat-card">
        <span class="stat-card-label">Guruhda</span>
        <span class="stat-card-value">{{ $group->enrollments()->where('status', 'active')->count() }}</span>
        <span class="stat-card-note">talaba ({{ $group->capacity }} joy)</span>
    </div>
</div>

@if ($upcoming->isNotEmpty())
    <section class="card">
        <div class="card-head">
            <h2>Kelgusi darslar</h2>
        </div>
        <div class="timeline">
            @foreach ($upcoming as $lesson)
                <div class="timeline-item">
                    <span class="timeline-date">{{ $lesson->starts_at->format('d.m') }}<small>{{ $lesson->starts_at->format('H:i') }}</small></span>
                    <div>
                        <strong>{{ $lesson->topic ?? $lesson->title }}</strong>
                        <span>{{ $lesson->duration_minutes }} daqiqa</span>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endif

<section class="card">
    <div class="card-head">
        <h2>Darslar va davomat</h2>
        <span class="muted">Jami {{ $lessons->count() }} dars</span>
    </div>

    <div class="table-wrap">
        <table class="data">
            <thead>
            <tr>
                <th>Sana</th>
                <th>Mavzu</th>
                <th>Davomiyligi</th>
                <th>Davomat</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($lessons->sortByDesc('starts_at') as $lesson)
                @php($attendance = $lesson->attendances->first())
                <tr>
                    <td>{{ $lesson->starts_at->format('d.m.Y H:i') }}</td>
                    <td>{{ $lesson->topic ?? $lesson->title }}</td>
                    <td>{{ $lesson->duration_minutes }} daq.</td>
                    <td>
                        @if (!$lesson->isPast())
                            <span class="badge badge-muted">Kutilmoqda</span>
                        @elseif ($attendance)
                            <span class="badge {{ in_array($attendance->status, ['present', 'late']) ? 'badge-success' : 'badge-danger' }}">{{ $attendance->label() }}</span>
                        @else
                            <span class="badge badge-muted">Belgilanmagan</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="table-empty">Darslar hali qo‘shilmagan.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</section>

<section class="card">
    <div class="card-head">
        <h2>To‘lovlar</h2>
        <a href="{{ route('cabinet.payments') }}" class="link-more">Barchasi →</a>
    </div>

    <div class="table-wrap">
        <table class="data">
            <thead>
            <tr>
                <th>Sana</th>
                <th>Summa</th>
                <th>Usul</th>
                <th>Holat</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($payments as $payment)
                <tr>
                    <td>{{ $payment->paid_at->format('d.m.Y') }}</td>
                    <td>{{ number_format($payment->amount, 0, '.', ' ') }} so‘m</td>
                    <td>{{ $payment->methodLabel() }}</td>
                    <td><span class="badge {{ $payment->status === 'paid' ? 'badge-success' : 'badge-warn' }}">{{ $payment->statusLabel() }}</span></td>
                </tr>
            @empty
                <tr><td colspan="4" class="table-empty">Bu guruh bo‘yicha to‘lov yo‘q.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</section>
@endsection

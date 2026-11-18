@extends('layouts.admin')

@section('title', 'Dashboard')
@section('header', 'Umumiy ko‘rsatkichlar')

@section('actions')
    <a href="{{ route('admin.payments.create') }}" class="btn btn-primary btn-sm">To‘lov qo‘shish</a>
@endsection

@section('content')
<div class="stat-grid">
    <div class="stat-card">
        <span class="stat-card-label">Talabalar</span>
        <span class="stat-card-value">{{ $stats['students'] }}</span>
        <span class="stat-card-note">ro‘yxatdagi</span>
    </div>
    <div class="stat-card">
        <span class="stat-card-label">Faol guruhlar</span>
        <span class="stat-card-value">{{ $stats['groups'] }}</span>
        <span class="stat-card-note">{{ $stats['courses'] }} kurs bo‘yicha</span>
    </div>
    <div class="stat-card">
        <span class="stat-card-label">O‘qituvchilar</span>
        <span class="stat-card-value">{{ $stats['teachers'] }}</span>
        <span class="stat-card-note">faol</span>
    </div>
    <div class="stat-card">
        <span class="stat-card-label">Yangi arizalar</span>
        <span class="stat-card-value">{{ $stats['newApplications'] }}</span>
        <span class="stat-card-note">javob kutilmoqda</span>
    </div>
    <div class="stat-card">
        <span class="stat-card-label">Oy tushumi</span>
        <span class="stat-card-value">{{ number_format($stats['monthRevenue'], 0, '.', ' ') }}</span>
        <span class="stat-card-note">so‘m</span>
    </div>
</div>

<div class="panel-columns">
    <section class="card">
        <div class="card-head">
            <h2>Oxirgi arizalar</h2>
            <a href="{{ route('admin.applications.index') }}" class="link-more">Barchasi →</a>
        </div>

        <div class="table-wrap">
            <table class="data">
                <thead>
                <tr>
                    <th>Ism</th>
                    <th>Telefon</th>
                    <th>Kurs</th>
                    <th>Holat</th>
                    <th>Sana</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($recentApplications as $application)
                    <tr>
                        <td>{{ $application->name }}</td>
                        <td><a href="tel:{{ $application->phone }}">{{ $application->phone }}</a></td>
                        <td>{{ $application->course?->title ?? '—' }}</td>
                        <td><span class="badge badge-{{ $application->status === 'new' ? 'warn' : ($application->status === 'enrolled' ? 'success' : 'muted') }}">{{ $application->statusLabel() }}</span></td>
                        <td class="muted">{{ $application->created_at->format('d.m.Y') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="table-empty">Arizalar yo‘q.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <section class="card">
        <div class="card-head">
            <h2>Oxirgi to‘lovlar</h2>
            <a href="{{ route('admin.payments.index') }}" class="link-more">Barchasi →</a>
        </div>

        <div class="table-wrap">
            <table class="data">
                <thead>
                <tr>
                    <th>Talaba</th>
                    <th>Summa</th>
                    <th>Sana</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($recentPayments as $payment)
                    <tr>
                        <td>{{ $payment->user->name }}</td>
                        <td>{{ number_format($payment->amount, 0, '.', ' ') }} so‘m</td>
                        <td class="muted">{{ $payment->paid_at->format('d.m.Y') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="table-empty">To‘lovlar yo‘q.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>

<section class="card">
    <div class="card-head">
        <h2>Eng ko‘p so‘ralgan kurslar</h2>
        <a href="{{ route('admin.courses.index') }}" class="link-more">Kurslar →</a>
    </div>

    <div class="table-wrap">
        <table class="data">
            <thead>
            <tr>
                <th>Kurs</th>
                <th>Kategoriya</th>
                <th>Guruhlar</th>
                <th>Arizalar</th>
                <th>Narx</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($popularCourses as $course)
                <tr>
                    <td>{{ $course->title }}</td>
                    <td><span class="chip">{{ $course->category }}</span></td>
                    <td>{{ $course->groups_count }}</td>
                    <td>{{ $course->applications_count }}</td>
                    <td>{{ number_format($course->price, 0, '.', ' ') }} so‘m</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection

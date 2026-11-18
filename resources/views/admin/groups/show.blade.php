@extends('layouts.admin')

@section('title', $group->name)
@section('kicker', $group->course->title)
@section('header', $group->name)

@section('actions')
    <a href="{{ route('admin.groups.edit', $group) }}" class="btn btn-soft btn-sm">Tahrirlash</a>
    <form method="POST" action="{{ route('admin.groups.destroy', $group) }}" onsubmit="return confirm('Guruhni o‘chirishni tasdiqlaysizmi? Barcha darslar ham o‘chadi.');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm">O‘chirish</button>
    </form>
@endsection

@section('content')
<a href="{{ route('admin.groups.index') }}" class="back-link">← Guruhlar ro‘yxati</a>

<div class="info-grid">
    <div class="info-item"><span class="info-label">Kurs</span><span class="info-value">{{ $group->course->title }}</span></div>
    <div class="info-item"><span class="info-label">O‘qituvchi</span><span class="info-value">{{ $group->teacher?->name ?? 'Tayinlanmagan' }}</span></div>
    <div class="info-item"><span class="info-label">Jadval</span><span class="info-value">{{ $group->schedule }}</span></div>
    <div class="info-item"><span class="info-label">Xona</span><span class="info-value">{{ $group->room ?? '—' }}</span></div>
    <div class="info-item"><span class="info-label">Boshlanish</span><span class="info-value">{{ $group->starts_at->format('d.m.Y') }}</span></div>
    <div class="info-item"><span class="info-label">Bo‘sh joy</span><span class="info-value">{{ $group->seatsLeft() }} / {{ $group->capacity }}</span></div>
</div>

<section class="card">
    <div class="card-head">
        <h2>Talabalar ({{ $group->enrollments->count() }})</h2>
    </div>

    <div class="table-wrap">
        <table class="data">
            <thead>
            <tr>
                <th>Ism</th>
                <th>Telefon</th>
                <th>Email</th>
                <th>Yozilgan sana</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse ($group->enrollments as $enrollment)
                <tr>
                    <td><strong>{{ $enrollment->user->name }}</strong></td>
                    <td>{{ $enrollment->user->phone ?? '—' }}</td>
                    <td class="muted">{{ $enrollment->user->email }}</td>
                    <td>{{ $enrollment->enrolled_at->format('d.m.Y') }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.groups.students.destroy', [$group, $enrollment->user]) }}" onsubmit="return confirm('Talabani guruhdan chiqarishni tasdiqlaysizmi?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="link-danger">Chiqarish</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="table-empty">Guruhda hali talaba yo‘q.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <form method="POST" action="{{ route('admin.groups.students.store', $group) }}" class="inline-form" style="margin-top: 16px;">
        @csrf
        <div class="field">
            <label for="user_id">Talaba qo‘shish</label>
            <select id="user_id" name="user_id" required>
                <option value="">Talabani tanlang</option>
                @foreach ($availableStudents as $student)
                    <option value="{{ $student->id }}">{{ $student->name }} — {{ $student->email }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary btn-sm">Qo‘shish</button>
    </form>
</section>

<section class="card">
    <div class="card-head">
        <h2>Darslar ({{ $group->lessons->count() }})</h2>
        <span class="muted">Davomatni dars sahifasida belgilaysiz</span>
    </div>

    <div class="table-wrap">
        <table class="data">
            <thead>
            <tr>
                <th>Vaqt</th>
                <th>Dars</th>
                <th>Mavzu</th>
                <th>Davomat</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse ($group->lessons as $lesson)
                <tr>
                    <td>{{ $lesson->starts_at->format('d.m.Y H:i') }}</td>
                    <td>{{ $lesson->title }}</td>
                    <td class="muted">{{ $lesson->topic }}</td>
                    <td>
                        @if ($lesson->attendances->count())
                            <span class="badge badge-success">{{ $lesson->attendances->count() }} belgilangan</span>
                        @else
                            <span class="badge badge-muted">Belgilanmagan</span>
                        @endif
                    </td>
                    <td>
                        <div class="table-actions">
                            <a href="{{ route('admin.lessons.show', $lesson) }}" class="btn btn-soft btn-sm">Davomat</a>
                            <form method="POST" action="{{ route('admin.lessons.destroy', $lesson) }}" onsubmit="return confirm('Darsni o‘chirishni tasdiqlaysizmi?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="link-danger">O‘chirish</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="table-empty">Darslar hali qo‘shilmagan.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <form method="POST" action="{{ route('admin.groups.lessons.store', $group) }}" class="inline-form" style="margin-top: 16px;">
        @csrf
        <div class="field">
            <label for="lesson-title">Dars nomi</label>
            <input id="lesson-title" type="text" name="title" placeholder="Dars 7" required>
        </div>
        <div class="field">
            <label for="lesson-topic">Mavzu</label>
            <input id="lesson-topic" type="text" name="topic" placeholder="Speaking Part 2">
        </div>
        <div class="field">
            <label for="lesson-starts">Vaqt</label>
            <input id="lesson-starts" type="datetime-local" name="starts_at" value="{{ now()->addDay()->format('Y-m-d\TH:i') }}" required>
        </div>
        <div class="field" style="max-width: 130px;">
            <label for="lesson-duration">Daqiqa</label>
            <input id="lesson-duration" type="number" name="duration_minutes" value="90" min="15" max="300" required>
        </div>
        <button type="submit" class="btn btn-primary btn-sm">Dars qo‘shish</button>
    </form>
</section>
@endsection

@extends('layouts.admin')

@section('title', 'Davomat')
@section('kicker', $lesson->studyGroup->course->title)
@section('header', 'Davomat: '.$lesson->starts_at->format('d.m.Y H:i'))

@section('content')
<a href="{{ route('admin.groups.show', $lesson->studyGroup) }}" class="back-link">← {{ $lesson->studyGroup->name }}</a>

<div class="info-grid">
    <div class="info-item"><span class="info-label">Guruh</span><span class="info-value">{{ $lesson->studyGroup->name }}</span></div>
    <div class="info-item"><span class="info-label">Dars</span><span class="info-value">{{ $lesson->title }}</span></div>
    <div class="info-item"><span class="info-label">Mavzu</span><span class="info-value">{{ $lesson->topic ?? '—' }}</span></div>
    <div class="info-item"><span class="info-label">Davomiyligi</span><span class="info-value">{{ $lesson->duration_minutes }} daqiqa</span></div>
</div>

<form method="POST" action="{{ route('admin.lessons.attendance.store', $lesson) }}">
    @csrf
    <section class="card">
        <div class="card-head">
            <h2>Talabalar davomati</h2>
            <span class="muted">{{ $students->count() }} talaba</span>
        </div>

        <div class="table-wrap">
            <table class="data">
                <thead>
                <tr>
                    <th>Talaba</th>
                    @foreach (\App\Models\Attendance::STATUSES as $label)
                        <th>{{ $label }}</th>
                    @endforeach
                    <th>Izoh</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($students as $student)
                    @php($current = $attendanceByUser->get($student->id))
                    <tr>
                        <td><strong>{{ $student->name }}</strong></td>
                        @foreach (\App\Models\Attendance::STATUSES as $value => $label)
                            <td>
                                <input type="radio"
                                       name="statuses[{{ $student->id }}]"
                                       value="{{ $value }}"
                                       @checked(($current->status ?? 'present') === $value)>
                            </td>
                        @endforeach
                        <td>
                            <input type="text" name="notes[{{ $student->id }}]" value="{{ $current->note ?? '' }}" placeholder="ixtiyoriy" style="min-width: 140px; padding: 8px 10px; border: 1px solid var(--line-strong); border-radius: 8px;">
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="table-empty">Guruhda talaba yo‘q.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Davomatni saqlash</button>
        </div>
    </section>
</form>
@endsection

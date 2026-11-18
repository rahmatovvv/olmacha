@extends('layouts.admin')

@section('title', 'Kurslar')
@section('kicker', 'Katalog')
@section('header', 'Kurslar')

@section('actions')
    <a href="{{ route('admin.courses.create') }}" class="btn btn-primary btn-sm">Yangi kurs</a>
@endsection

@section('content')
<div class="toolbar">
    <form method="GET" action="{{ route('admin.courses.index') }}">
        <input type="text" name="q" value="{{ $search }}" placeholder="Kurs nomi yoki kategoriya">
        <button type="submit" class="btn btn-ghost btn-sm">Qidirish</button>
        @if ($search !== '')
            <a href="{{ route('admin.courses.index') }}" class="btn btn-ghost btn-sm">Tozalash</a>
        @endif
    </form>
</div>

<section class="card">
    <div class="table-wrap">
        <table class="data">
            <thead>
            <tr>
                <th>Kurs</th>
                <th>Kategoriya</th>
                <th>Davomiyligi</th>
                <th>Narx</th>
                <th>Guruhlar</th>
                <th>Holat</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse ($courses as $course)
                <tr>
                    <td>
                        <strong>{{ $course->title }}</strong>
                        <div class="muted">{{ $course->level }}</div>
                    </td>
                    <td><span class="chip">{{ $course->category }}</span></td>
                    <td>{{ $course->duration_months }} oy · {{ $course->lessons_per_week }}x</td>
                    <td>{{ number_format($course->price, 0, '.', ' ') }} so‘m</td>
                    <td>{{ $course->groups_count }}</td>
                    <td>
                        @if ($course->is_active)
                            <span class="badge badge-success">Faol</span>
                        @else
                            <span class="badge badge-muted">O‘chirilgan</span>
                        @endif
                        @if ($course->is_featured)
                            <span class="badge badge-warn">Top</span>
                        @endif
                    </td>
                    <td>
                        <div class="table-actions">
                            <a href="{{ route('courses.show', $course) }}" class="btn btn-ghost btn-sm" target="_blank">Ko‘rish</a>
                            <a href="{{ route('admin.courses.edit', $course) }}" class="btn btn-soft btn-sm">Tahrirlash</a>
                            <form method="POST" action="{{ route('admin.courses.destroy', $course) }}" onsubmit="return confirm('Kursni o‘chirishni tasdiqlaysizmi?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="link-danger">O‘chirish</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="table-empty">Kurslar topilmadi.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{ $courses->links('pagination.simple') }}
</section>
@endsection

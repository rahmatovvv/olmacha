@extends('layouts.admin')

@section('title', 'O‘qituvchilar')
@section('kicker', 'Jamoa')
@section('header', 'O‘qituvchilar')

@section('actions')
    <a href="{{ route('admin.teachers.create') }}" class="btn btn-primary btn-sm">Yangi o‘qituvchi</a>
@endsection

@section('content')
<div class="toolbar">
    <form method="GET" action="{{ route('admin.teachers.index') }}">
        <input type="text" name="q" value="{{ $search }}" placeholder="Ism bo‘yicha qidirish">
        <button type="submit" class="btn btn-ghost btn-sm">Qidirish</button>
    </form>
</div>

<section class="card">
    <div class="table-wrap">
        <table class="data">
            <thead>
            <tr>
                <th>O‘qituvchi</th>
                <th>Mutaxassislik</th>
                <th>Tajriba</th>
                <th>Guruhlar</th>
                <th>Aloqa</th>
                <th>Holat</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse ($teachers as $teacher)
                <tr>
                    <td><strong>{{ $teacher->name }}</strong></td>
                    <td>{{ $teacher->specialty }}</td>
                    <td>{{ $teacher->experience_years }} yil</td>
                    <td>{{ $teacher->groups_count }}</td>
                    <td class="muted">{{ $teacher->phone }}</td>
                    <td>
                        @if ($teacher->is_active)
                            <span class="badge badge-success">Faol</span>
                        @else
                            <span class="badge badge-muted">Faol emas</span>
                        @endif
                    </td>
                    <td>
                        <div class="table-actions">
                            <a href="{{ route('admin.teachers.edit', $teacher) }}" class="btn btn-soft btn-sm">Tahrirlash</a>
                            <form method="POST" action="{{ route('admin.teachers.destroy', $teacher) }}" onsubmit="return confirm('O‘qituvchini o‘chirishni tasdiqlaysizmi?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="link-danger">O‘chirish</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="table-empty">O‘qituvchilar topilmadi.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{ $teachers->links('pagination.simple') }}
</section>
@endsection

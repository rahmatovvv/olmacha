@extends('layouts.admin')

@section('title', 'Guruhlar')
@section('kicker', 'O‘quv jarayoni')
@section('header', 'Guruhlar')

@section('actions')
    <a href="{{ route('admin.groups.create') }}" class="btn btn-primary btn-sm">Yangi guruh</a>
@endsection

@section('content')
<div class="toolbar">
    <form method="GET" action="{{ route('admin.groups.index') }}">
        <input type="text" name="q" value="{{ $search }}" placeholder="Guruh nomi">
        <button type="submit" class="btn btn-ghost btn-sm">Qidirish</button>
    </form>
</div>

<section class="card">
    <div class="table-wrap">
        <table class="data">
            <thead>
            <tr>
                <th>Guruh</th>
                <th>Kurs</th>
                <th>O‘qituvchi</th>
                <th>Jadval</th>
                <th>Boshlanish</th>
                <th>Talabalar</th>
                <th>Holat</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse ($groups as $group)
                <tr>
                    <td><strong>{{ $group->name }}</strong><div class="muted">{{ $group->room }}</div></td>
                    <td>{{ $group->course->title }}</td>
                    <td>{{ $group->teacher?->name ?? '—' }}</td>
                    <td>{{ $group->schedule }}</td>
                    <td>{{ $group->starts_at->format('d.m.Y') }}</td>
                    <td>{{ $group->enrollments_count }} / {{ $group->capacity }}</td>
                    <td>
                        @if ($group->is_active)
                            <span class="badge badge-success">Faol</span>
                        @else
                            <span class="badge badge-muted">Yopilgan</span>
                        @endif
                    </td>
                    <td>
                        <div class="table-actions">
                            <a href="{{ route('admin.groups.show', $group) }}" class="btn btn-soft btn-sm">Ochish</a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="8" class="table-empty">Guruhlar topilmadi.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{ $groups->links('pagination.simple') }}
</section>
@endsection

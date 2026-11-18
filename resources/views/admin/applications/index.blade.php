@extends('layouts.admin')

@section('title', 'Arizalar')
@section('kicker', 'Murojaatlar')
@section('header', 'Arizalar')

@section('content')
<div class="toolbar">
    <div class="filter-chips">
        <a href="{{ route('admin.applications.index') }}" class="chip {{ $status === '' ? 'is-active' : '' }}">Barchasi ({{ $counts->sum() }})</a>
        @foreach (\App\Models\Application::STATUSES as $key => $label)
            <a href="{{ route('admin.applications.index', ['holat' => $key]) }}" class="chip {{ $status === $key ? 'is-active' : '' }}">{{ $label }} ({{ $counts[$key] ?? 0 }})</a>
        @endforeach
    </div>

    <form method="GET" action="{{ route('admin.applications.index') }}" style="margin-left: auto;">
        @if ($status !== '')
            <input type="hidden" name="holat" value="{{ $status }}">
        @endif
        <input type="text" name="q" value="{{ $search }}" placeholder="Ism yoki telefon">
        <button type="submit" class="btn btn-ghost btn-sm">Qidirish</button>
    </form>
</div>

<section class="card">
    <div class="table-wrap">
        <table class="data">
            <thead>
            <tr>
                <th>Ism</th>
                <th>Telefon</th>
                <th>Kurs</th>
                <th>Izoh</th>
                <th>Sana</th>
                <th>Holat</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse ($applications as $application)
                <tr>
                    <td>
                        <strong>{{ $application->name }}</strong>
                        <div class="muted">{{ $application->email }}</div>
                    </td>
                    <td><a href="tel:{{ $application->phone }}">{{ $application->phone }}</a></td>
                    <td>{{ $application->course?->title ?? '—' }}</td>
                    <td class="muted" style="max-width: 280px;">{{ \Illuminate\Support\Str::limit($application->message, 90) }}</td>
                    <td class="muted">{{ $application->created_at->format('d.m.Y H:i') }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.applications.update', $application) }}" class="inline-form">
                            @csrf
                            @method('PUT')
                            <select name="status" onchange="this.form.submit()" style="min-width: 140px;">
                                @foreach (\App\Models\Application::STATUSES as $key => $label)
                                    <option value="{{ $key }}" @selected($application->status === $key)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </form>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('admin.applications.destroy', $application) }}" onsubmit="return confirm('Arizani o‘chirishni tasdiqlaysizmi?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="link-danger">O‘chirish</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="table-empty">Arizalar topilmadi.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{ $applications->links('pagination.simple') }}
</section>
@endsection

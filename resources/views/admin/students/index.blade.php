@extends('layouts.admin')

@section('title', 'Talabalar')
@section('kicker', 'Foydalanuvchilar')
@section('header', 'Talabalar')

@section('actions')
    <a href="{{ route('admin.students.create') }}" class="btn btn-primary btn-sm">Yangi talaba</a>
@endsection

@section('content')
<div class="toolbar">
    <form method="GET" action="{{ route('admin.students.index') }}">
        <input type="text" name="q" value="{{ $search }}" placeholder="Ism, email yoki telefon">
        <button type="submit" class="btn btn-ghost btn-sm">Qidirish</button>
    </form>
</div>

<section class="card">
    <div class="table-wrap">
        <table class="data">
            <thead>
            <tr>
                <th>Talaba</th>
                <th>Telefon</th>
                <th>Guruhlar</th>
                <th>To‘langan</th>
                <th>Ro‘yxatdan o‘tgan</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse ($students as $student)
                <tr>
                    <td>
                        <strong>{{ $student->name }}</strong>
                        <div class="muted">{{ $student->email }}</div>
                    </td>
                    <td>{{ $student->phone ?? '—' }}</td>
                    <td>{{ $student->enrollments_count }}</td>
                    <td>{{ number_format($student->payments_sum_amount ?? 0, 0, '.', ' ') }} so‘m</td>
                    <td class="muted">{{ $student->created_at->format('d.m.Y') }}</td>
                    <td>
                        <div class="table-actions">
                            <a href="{{ route('admin.students.edit', $student) }}" class="btn btn-soft btn-sm">Tahrirlash</a>
                            <form method="POST" action="{{ route('admin.students.destroy', $student) }}" onsubmit="return confirm('Talabani o‘chirishni tasdiqlaysizmi?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="link-danger">O‘chirish</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="table-empty">Talabalar topilmadi.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{ $students->links('pagination.simple') }}
</section>
@endsection

@extends('layouts.admin')

@section('title', 'To‘lovlar')
@section('kicker', 'Moliya')
@section('header', 'To‘lovlar')

@section('actions')
    <a href="{{ route('admin.payments.create') }}" class="btn btn-primary btn-sm">To‘lov qo‘shish</a>
@endsection

@section('content')
<div class="stat-grid">
    <div class="stat-card">
        <span class="stat-card-label">Bu oy tushumi</span>
        <span class="stat-card-value">{{ number_format($monthTotal, 0, '.', ' ') }}</span>
        <span class="stat-card-note">so‘m</span>
    </div>
</div>

<div class="toolbar">
    <form method="GET" action="{{ route('admin.payments.index') }}">
        <input type="text" name="q" value="{{ $search }}" placeholder="Talaba ismi">
        <select name="holat">
            <option value="">Barcha holatlar</option>
            @foreach (\App\Models\Payment::STATUSES as $key => $label)
                <option value="{{ $key }}" @selected($status === $key)>{{ $label }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-ghost btn-sm">Filtrlash</button>
    </form>
</div>

<section class="card">
    <div class="table-wrap">
        <table class="data">
            <thead>
            <tr>
                <th>Talaba</th>
                <th>Guruh</th>
                <th>Summa</th>
                <th>Usul</th>
                <th>Sana</th>
                <th>Holat</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse ($payments as $payment)
                <tr>
                    <td><strong>{{ $payment->user->name }}</strong></td>
                    <td>{{ $payment->studyGroup?->name ?? '—' }}</td>
                    <td>{{ number_format($payment->amount, 0, '.', ' ') }} so‘m</td>
                    <td>{{ $payment->methodLabel() }}</td>
                    <td>{{ $payment->paid_at->format('d.m.Y') }}</td>
                    <td>
                        <span class="badge {{ $payment->status === 'paid' ? 'badge-success' : 'badge-warn' }}">{{ $payment->statusLabel() }}</span>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('admin.payments.destroy', $payment) }}" onsubmit="return confirm('To‘lovni o‘chirishni tasdiqlaysizmi?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="link-danger">O‘chirish</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="table-empty">To‘lovlar topilmadi.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{ $payments->links('pagination.simple') }}
</section>
@endsection

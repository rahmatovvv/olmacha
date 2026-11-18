@extends('layouts.cabinet')

@section('title', 'To‘lovlar')
@section('kicker', 'Moliya')
@section('header', 'To‘lovlar tarixi')

@section('content')
<div class="stat-grid">
    <div class="stat-card">
        <span class="stat-card-label">Jami to‘langan</span>
        <span class="stat-card-value">{{ number_format($totalPaid, 0, '.', ' ') }}</span>
        <span class="stat-card-note">so‘m</span>
    </div>
    <div class="stat-card">
        <span class="stat-card-label">To‘lovlar soni</span>
        <span class="stat-card-value">{{ $payments->total() }}</span>
        <span class="stat-card-note">qayd etilgan</span>
    </div>
</div>

<section class="card">
    <div class="card-head">
        <h2>Barcha to‘lovlar</h2>
    </div>

    <div class="table-wrap">
        <table class="data">
            <thead>
            <tr>
                <th>Sana</th>
                <th>Kurs</th>
                <th>Summa</th>
                <th>Usul</th>
                <th>Holat</th>
                <th>Izoh</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($payments as $payment)
                <tr>
                    <td>{{ $payment->paid_at->format('d.m.Y') }}</td>
                    <td>{{ $payment->studyGroup?->course?->title ?? 'Umumiy' }}</td>
                    <td>{{ number_format($payment->amount, 0, '.', ' ') }} so‘m</td>
                    <td>{{ $payment->methodLabel() }}</td>
                    <td><span class="badge {{ $payment->status === 'paid' ? 'badge-success' : 'badge-warn' }}">{{ $payment->statusLabel() }}</span></td>
                    <td class="muted">{{ $payment->note }}</td>
                </tr>
            @empty
                <tr><td colspan="6" class="table-empty">To‘lovlar hali qayd etilmagan.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{ $payments->links('pagination.simple') }}
</section>
@endsection

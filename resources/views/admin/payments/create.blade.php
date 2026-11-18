@extends('layouts.admin')

@section('title', 'To‘lov qo‘shish')
@section('kicker', 'Moliya')
@section('header', 'Yangi to‘lov')

@section('content')
<section class="card form-card">
    <form method="POST" action="{{ route('admin.payments.store') }}">
        @csrf

        <div class="form-grid">
            <div class="field">
                <label for="user_id">Talaba *</label>
                <select id="user_id" name="user_id" required>
                    <option value="">Tanlang</option>
                    @foreach ($students as $student)
                        <option value="{{ $student->id }}" @selected(old('user_id') == $student->id)>{{ $student->name }} — {{ $student->email }}</option>
                    @endforeach
                </select>
            </div>

            <div class="field">
                <label for="study_group_id">Guruh</label>
                <select id="study_group_id" name="study_group_id">
                    <option value="">Umumiy to‘lov</option>
                    @foreach ($groups as $group)
                        <option value="{{ $group->id }}" @selected(old('study_group_id') == $group->id)>{{ $group->name }} — {{ $group->course->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="field">
                <label for="amount">Summa (so‘m) *</label>
                <input id="amount" type="number" name="amount" min="0" step="1000" value="{{ old('amount') }}" required>
            </div>

            <div class="field">
                <label for="paid_at">To‘lov sanasi *</label>
                <input id="paid_at" type="date" name="paid_at" value="{{ old('paid_at', now()->toDateString()) }}" required>
            </div>

            <div class="field">
                <label for="method">To‘lov usuli *</label>
                <select id="method" name="method" required>
                    @foreach (\App\Models\Payment::METHODS as $key => $label)
                        <option value="{{ $key }}" @selected(old('method') === $key)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            <div class="field">
                <label for="status">Holat *</label>
                <select id="status" name="status" required>
                    @foreach (\App\Models\Payment::STATUSES as $key => $label)
                        <option value="{{ $key }}" @selected(old('status', 'paid') === $key)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            <div class="field field-full">
                <label for="note">Izoh</label>
                <input id="note" type="text" name="note" value="{{ old('note') }}" placeholder="Masalan: mart oyi uchun">
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Saqlash</button>
            <a href="{{ route('admin.payments.index') }}" class="btn btn-ghost">Bekor qilish</a>
        </div>
    </form>
</section>
@endsection

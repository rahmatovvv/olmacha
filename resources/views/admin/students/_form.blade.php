@php
    $model = $student ?? null;
@endphp

<form method="POST" action="{{ $model ? route('admin.students.update', $model) : route('admin.students.store') }}">
    @csrf
    @if ($model)
        @method('PUT')
    @endif

    <div class="form-grid">
        <div class="field">
            <label for="name">Ism va familiya *</label>
            <input id="name" type="text" name="name" value="{{ old('name', $model->name ?? '') }}" required>
        </div>

        <div class="field">
            <label for="email">Email *</label>
            <input id="email" type="email" name="email" value="{{ old('email', $model->email ?? '') }}" required>
        </div>

        <div class="field">
            <label for="phone">Telefon</label>
            <input id="phone" type="text" name="phone" value="{{ old('phone', $model->phone ?? '') }}" placeholder="+998 90 123 45 67">
        </div>

        <div class="field">
            <label for="password">Parol {{ $model ? '(bo‘sh qoldirsangiz o‘zgarmaydi)' : '*' }}</label>
            <input id="password" type="password" name="password" {{ $model ? '' : 'required' }} placeholder="Kamida 8 belgi">
        </div>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">{{ $model ? 'Saqlash' : 'Talaba qo‘shish' }}</button>
        <a href="{{ route('admin.students.index') }}" class="btn btn-ghost">Bekor qilish</a>
    </div>
</form>

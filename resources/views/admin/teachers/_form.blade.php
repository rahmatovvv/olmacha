@php
    $model = $teacher ?? null;
@endphp

<form method="POST" action="{{ $model ? route('admin.teachers.update', $model) : route('admin.teachers.store') }}">
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
            <label for="specialty">Mutaxassislik *</label>
            <input id="specialty" type="text" name="specialty" value="{{ old('specialty', $model->specialty ?? '') }}" placeholder="Ingliz tili, IELTS" required>
        </div>

        <div class="field">
            <label for="experience_years">Tajriba (yil) *</label>
            <input id="experience_years" type="number" name="experience_years" min="0" max="60" value="{{ old('experience_years', $model->experience_years ?? 1) }}" required>
        </div>

        <div class="field">
            <label for="phone">Telefon</label>
            <input id="phone" type="text" name="phone" value="{{ old('phone', $model->phone ?? '') }}">
        </div>

        <div class="field">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email', $model->email ?? '') }}">
        </div>

        <div class="field field-full">
            <label for="bio">Bio</label>
            <textarea id="bio" name="bio" rows="5">{{ old('bio', $model->bio ?? '') }}</textarea>
        </div>

        <div class="field field-full">
            <label class="checkbox">
                <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $model->is_active ?? true))>
                <span>Saytda ko‘rsatish</span>
            </label>
        </div>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">{{ $model ? 'Saqlash' : 'Qo‘shish' }}</button>
        <a href="{{ route('admin.teachers.index') }}" class="btn btn-ghost">Bekor qilish</a>
    </div>
</form>

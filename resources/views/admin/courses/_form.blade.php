@php
    $model = $course ?? null;
@endphp

<form method="POST" action="{{ $model ? route('admin.courses.update', $model) : route('admin.courses.store') }}">
    @csrf
    @if ($model)
        @method('PUT')
    @endif

    <div class="form-grid">
        <div class="field field-full">
            <label for="title">Kurs nomi *</label>
            <input id="title" type="text" name="title" value="{{ old('title', $model->title ?? '') }}" required>
        </div>

        <div class="field">
            <label for="category">Kategoriya *</label>
            <input id="category" type="text" name="category" value="{{ old('category', $model->category ?? '') }}" placeholder="Chet tillari / IT / Aniq fanlar" required>
        </div>

        <div class="field">
            <label for="level">Daraja</label>
            <input id="level" type="text" name="level" value="{{ old('level', $model->level ?? '') }}" placeholder="Boshlang‘ich — o‘rta">
        </div>

        <div class="field field-full">
            <label for="summary">Qisqa tavsif *</label>
            <input id="summary" type="text" name="summary" value="{{ old('summary', $model->summary ?? '') }}" maxlength="255" required>
        </div>

        <div class="field field-full">
            <label for="description">To‘liq tavsif *</label>
            <textarea id="description" name="description" rows="6" required>{{ old('description', $model->description ?? '') }}</textarea>
        </div>

        <div class="field field-full">
            <label for="syllabus">Kurs dasturi</label>
            <textarea id="syllabus" name="syllabus" rows="6" placeholder="Har bir qator alohida band bo‘ladi">{{ old('syllabus', $model->syllabus ?? '') }}</textarea>
            <small>Har bir modulni yangi qatorga yozing.</small>
        </div>

        <div class="field">
            <label for="duration_months">Davomiyligi (oy) *</label>
            <input id="duration_months" type="number" name="duration_months" min="1" max="36" value="{{ old('duration_months', $model->duration_months ?? 3) }}" required>
        </div>

        <div class="field">
            <label for="lessons_per_week">Haftada darslar *</label>
            <input id="lessons_per_week" type="number" name="lessons_per_week" min="1" max="7" value="{{ old('lessons_per_week', $model->lessons_per_week ?? 2) }}" required>
        </div>

        <div class="field">
            <label for="price">Narx (so‘m / oy) *</label>
            <input id="price" type="number" name="price" min="0" step="1000" value="{{ old('price', $model->price ?? 0) }}" required>
        </div>

        <div class="field">
            <label for="slug">URL manzil (ixtiyoriy)</label>
            <input id="slug" type="text" name="slug" value="{{ old('slug', $model->slug ?? '') }}" placeholder="avtomatik yaratiladi">
        </div>

        <div class="field field-full">
            <label class="checkbox">
                <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $model->is_featured ?? false))>
                <span>Bosh sahifada “Top tanlov” sifatida ko‘rsatish</span>
            </label>
            <label class="checkbox">
                <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $model->is_active ?? true))>
                <span>Saytda faol</span>
            </label>
        </div>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">{{ $model ? 'Saqlash' : 'Kurs qo‘shish' }}</button>
        <a href="{{ route('admin.courses.index') }}" class="btn btn-ghost">Bekor qilish</a>
    </div>
</form>

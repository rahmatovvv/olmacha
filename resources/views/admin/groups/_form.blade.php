@php
    $model = $group ?? null;
@endphp

<form method="POST" action="{{ $model ? route('admin.groups.update', $model) : route('admin.groups.store') }}">
    @csrf
    @if ($model)
        @method('PUT')
    @endif

    <div class="form-grid">
        <div class="field">
            <label for="course_id">Kurs *</label>
            <select id="course_id" name="course_id" required>
                <option value="">Tanlang</option>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}" @selected(old('course_id', $model->course_id ?? '') == $course->id)>{{ $course->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="field">
            <label for="teacher_id">O‘qituvchi</label>
            <select id="teacher_id" name="teacher_id">
                <option value="">Tayinlanmagan</option>
                @foreach ($teachers as $teacher)
                    <option value="{{ $teacher->id }}" @selected(old('teacher_id', $model->teacher_id ?? '') == $teacher->id)>{{ $teacher->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="field">
            <label for="name">Guruh nomi *</label>
            <input id="name" type="text" name="name" value="{{ old('name', $model->name ?? '') }}" placeholder="IELTS-INT-01" required>
        </div>

        <div class="field">
            <label for="room">Xona</label>
            <input id="room" type="text" name="room" value="{{ old('room', $model->room ?? '') }}" placeholder="201-xona">
        </div>

        <div class="field">
            <label for="schedule">Jadval *</label>
            <input id="schedule" type="text" name="schedule" value="{{ old('schedule', $model->schedule ?? '') }}" placeholder="Du, Cho, Ju — 18:00" required>
        </div>

        <div class="field">
            <label for="capacity">Joy soni *</label>
            <input id="capacity" type="number" name="capacity" min="1" max="60" value="{{ old('capacity', $model->capacity ?? 12) }}" required>
        </div>

        <div class="field">
            <label for="starts_at">Boshlanish sanasi *</label>
            <input id="starts_at" type="date" name="starts_at" value="{{ old('starts_at', isset($model) ? $model->starts_at->format('Y-m-d') : now()->toDateString()) }}" required>
        </div>

        <div class="field">
            <label for="ends_at">Tugash sanasi</label>
            <input id="ends_at" type="date" name="ends_at" value="{{ old('ends_at', isset($model) && $model->ends_at ? $model->ends_at->format('Y-m-d') : '') }}">
        </div>

        <div class="field field-full">
            <label class="checkbox">
                <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $model->is_active ?? true))>
                <span>Guruh faol (yangi talaba qabul qilinadi)</span>
            </label>
        </div>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">{{ $model ? 'Saqlash' : 'Guruh yaratish' }}</button>
        <a href="{{ $model ? route('admin.groups.show', $model) : route('admin.groups.index') }}" class="btn btn-ghost">Bekor qilish</a>
    </div>
</form>

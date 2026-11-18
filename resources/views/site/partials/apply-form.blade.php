@php
    $hasCourse = isset($course) && $course;
@endphp

<form method="POST" action="{{ route('applications.store') }}" class="apply-form">
    @csrf

    @if ($hasCourse)
        <input type="hidden" name="course_id" value="{{ $course->id }}">
    @endif

    <div class="field">
        <label for="apply-name">Ismingiz *</label>
        <input id="apply-name" type="text" name="name" value="{{ old('name') }}" placeholder="Masalan: Malika Yusupova" required>
    </div>

    <div class="field">
        <label for="apply-phone">Telefon raqam *</label>
        <input id="apply-phone" type="text" name="phone" value="{{ old('phone') }}" placeholder="+998 90 123 45 67" required>
    </div>

    @unless ($hasCourse)
        <div class="field">
            <label for="apply-email">Email</label>
            <input id="apply-email" type="email" name="email" value="{{ old('email') }}" placeholder="siz@example.com">
        </div>

        <div class="field">
            <label for="apply-course">Qaysi kurs qiziqtiradi?</label>
            <select id="apply-course" name="course_id">
                <option value="">Tanlanmagan</option>
                @foreach ($courses as $item)
                    <option value="{{ $item->id }}" @selected(old('course_id') == $item->id)>{{ $item->title }}</option>
                @endforeach
            </select>
        </div>
    @endunless

    <div class="field">
        <label for="apply-message">Izoh</label>
        <textarea id="apply-message" name="message" rows="3" placeholder="Qulay vaqt, daraja yoki savolingiz">{{ old('message') }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary btn-block">Arizani yuborish</button>
    <p class="form-note">Ma’lumotlaringiz faqat bog‘lanish uchun ishlatiladi.</p>
</form>

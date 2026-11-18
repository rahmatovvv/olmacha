<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines (Uzbek)
    |--------------------------------------------------------------------------
    */

    'accepted' => ':attribute maydoni qabul qilinishi kerak.',
    'active_url' => ':attribute haqiqiy URL bo\'lishi kerak.',
    'after' => ':attribute :date sanasidan keyingi sana bo\'lishi kerak.',
    'after_or_equal' => ':attribute :date sanasidan keyin yoki unga teng bo\'lishi kerak.',
    'alpha' => ':attribute faqat harflardan iborat bo\'lishi kerak.',
    'alpha_dash' => ':attribute faqat harflar, raqamlar, chiziqcha va pastki chiziqdan iborat bo\'lishi kerak.',
    'alpha_num' => ':attribute faqat harflar va raqamlardan iborat bo\'lishi kerak.',
    'array' => ':attribute ro\'yxat bo\'lishi kerak.',
    'before' => ':attribute :date sanasidan oldingi sana bo\'lishi kerak.',
    'before_or_equal' => ':attribute :date sanasidan oldin yoki unga teng bo\'lishi kerak.',
    'between' => [
        'numeric' => ':attribute :min va :max orasida bo\'lishi kerak.',
        'file' => ':attribute hajmi :min va :max kilobayt orasida bo\'lishi kerak.',
        'string' => ':attribute :min va :max belgi orasida bo\'lishi kerak.',
        'array' => ':attribute :min va :max element orasida bo\'lishi kerak.',
    ],
    'boolean' => ':attribute maydoni ha yoki yo\'q bo\'lishi kerak.',
    'confirmed' => ':attribute tasdiqlanishi mos kelmadi.',
    'date' => ':attribute haqiqiy sana bo\'lishi kerak.',
    'date_equals' => ':attribute :date sanasiga teng bo\'lishi kerak.',
    'date_format' => ':attribute :format formatiga mos bo\'lishi kerak.',
    'different' => ':attribute va :other bir-biridan farq qilishi kerak.',
    'digits' => ':attribute :digits xonali bo\'lishi kerak.',
    'digits_between' => ':attribute :min va :max xona orasida bo\'lishi kerak.',
    'email' => ':attribute haqiqiy email manzil bo\'lishi kerak.',
    'exists' => 'Tanlangan :attribute mavjud emas.',
    'file' => ':attribute fayl bo\'lishi kerak.',
    'filled' => ':attribute maydoni to\'ldirilishi kerak.',
    'gt' => [
        'numeric' => ':attribute :value dan katta bo\'lishi kerak.',
        'string' => ':attribute :value belgidan uzun bo\'lishi kerak.',
        'array' => ':attribute :value elementdan ko\'p bo\'lishi kerak.',
    ],
    'gte' => [
        'numeric' => ':attribute :value dan katta yoki teng bo\'lishi kerak.',
        'string' => ':attribute :value belgidan uzun yoki teng bo\'lishi kerak.',
        'array' => ':attribute kamida :value elementdan iborat bo\'lishi kerak.',
    ],
    'image' => ':attribute rasm bo\'lishi kerak.',
    'in' => 'Tanlangan :attribute noto\'g\'ri.',
    'integer' => ':attribute butun son bo\'lishi kerak.',
    'lt' => [
        'numeric' => ':attribute :value dan kichik bo\'lishi kerak.',
        'string' => ':attribute :value belgidan qisqa bo\'lishi kerak.',
        'array' => ':attribute :value elementdan kam bo\'lishi kerak.',
    ],
    'lte' => [
        'numeric' => ':attribute :value dan kichik yoki teng bo\'lishi kerak.',
        'string' => ':attribute :value belgidan qisqa yoki teng bo\'lishi kerak.',
        'array' => ':attribute :value elementdan ko\'p bo\'lmasligi kerak.',
    ],
    'max' => [
        'numeric' => ':attribute :max dan katta bo\'lmasligi kerak.',
        'file' => ':attribute hajmi :max kilobaytdan oshmasligi kerak.',
        'string' => ':attribute :max belgidan oshmasligi kerak.',
        'array' => ':attribute :max elementdan oshmasligi kerak.',
    ],
    'mimes' => ':attribute fayli :values turida bo\'lishi kerak.',
    'min' => [
        'numeric' => ':attribute kamida :min bo\'lishi kerak.',
        'file' => ':attribute hajmi kamida :min kilobayt bo\'lishi kerak.',
        'string' => ':attribute kamida :min belgidan iborat bo\'lishi kerak.',
        'array' => ':attribute kamida :min elementdan iborat bo\'lishi kerak.',
    ],
    'not_in' => 'Tanlangan :attribute noto\'g\'ri.',
    'numeric' => ':attribute son bo\'lishi kerak.',
    'present' => ':attribute maydoni mavjud bo\'lishi kerak.',
    'prohibited' => ':attribute maydoni taqiqlangan.',
    'regex' => ':attribute formati noto\'g\'ri.',
    'required' => ':attribute maydoni to\'ldirilishi shart.',
    'required_if' => ':other :value bo\'lganda :attribute maydoni to\'ldirilishi shart.',
    'required_unless' => ':other :values ichida bo\'lmasa, :attribute maydoni to\'ldirilishi shart.',
    'required_with' => ':values mavjud bo\'lganda :attribute maydoni to\'ldirilishi shart.',
    'required_without' => ':values mavjud bo\'lmaganda :attribute maydoni to\'ldirilishi shart.',
    'same' => ':attribute va :other mos kelishi kerak.',
    'size' => [
        'numeric' => ':attribute :size ga teng bo\'lishi kerak.',
        'file' => ':attribute hajmi :size kilobayt bo\'lishi kerak.',
        'string' => ':attribute :size belgidan iborat bo\'lishi kerak.',
        'array' => ':attribute :size elementdan iborat bo\'lishi kerak.',
    ],
    'starts_with' => ':attribute :values bilan boshlanishi kerak.',
    'string' => ':attribute matn bo\'lishi kerak.',
    'timezone' => ':attribute haqiqiy vaqt zonasi bo\'lishi kerak.',
    'unique' => 'Bu :attribute allaqachon ro\'yxatdan o\'tgan.',
    'uploaded' => ':attribute yuklanmadi.',
    'url' => ':attribute haqiqiy havola bo\'lishi kerak.',
    'uuid' => ':attribute haqiqiy UUID bo\'lishi kerak.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    */

    'attributes' => [
        'name' => 'ism',
        'email' => 'email',
        'password' => 'parol',
        'phone' => 'telefon raqam',
        'title' => 'nomi',
        'price' => 'narx',
        'amount' => 'summa',
    ],

];

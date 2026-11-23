<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Demo ma'lumotlarni faqat bo'sh bazada va faqat aniq ruxsat berilganda yozadi.
     * Production'da SEED_DEMO_DATA=true bo'lmasa hech narsa yaratilmaydi.
     */
    public function up(): void
    {
        if (DB::table('users')->exists() || DB::table('courses')->exists()) {
            return;
        }

        $enabled = env('SEED_DEMO_DATA', app()->environment('local'));

        if (! filter_var($enabled, FILTER_VALIDATE_BOOL)) {
            return;
        }

        Artisan::call('db:seed', ['--force' => true]);
    }

    public function down(): void
    {
        //
    }
};

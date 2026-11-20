<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Demo ma'lumotlarni faqat bo'sh bazada bir marta yozadi.
     */
    public function up(): void
    {
        if (DB::table('users')->exists()) {
            return;
        }

        Artisan::call('db:seed', ['--force' => true]);
    }

    public function down(): void
    {
        //
    }
};

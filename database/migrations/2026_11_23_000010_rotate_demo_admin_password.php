<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ochiq demo parolni (admin123) ADMIN_PASSWORD qiymatiga almashtiradi.
     * Parol muhit o'zgaruvchisida berilmagan bo'lsa, hech narsa o'zgartirilmaydi.
     */
    public function up(): void
    {
        $password = env('ADMIN_PASSWORD');
        $email = env('ADMIN_EMAIL', 'admin@olmacha.uz');

        if (! is_string($password) || $password === '') {
            return;
        }

        $admin = DB::table('users')->where('email', $email)->first();

        if ($admin === null || Hash::check($password, $admin->password)) {
            return;
        }

        DB::table('users')->where('id', $admin->id)->update([
            'password' => Hash::make($password),
            'remember_token' => null,
            'updated_at' => now(),
        ]);

        if (Schema::hasTable('sessions')) {
            DB::table('sessions')->where('user_id', $admin->id)->delete();
        }
    }

    public function down(): void
    {
        //
    }
};

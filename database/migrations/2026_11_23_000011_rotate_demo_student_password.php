<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Ochiq demo parolni (talaba123) yopadi.
     * Asosiy demo hisob DEMO_STUDENT_PASSWORD oladi, eski demo hisoblarga tasodifiy parol qo'yiladi.
     */
    public function up(): void
    {
        $password = env('DEMO_STUDENT_PASSWORD');
        $email = env('DEMO_STUDENT_EMAIL', 'talaba@olmacha.uz');

        if (! is_string($password) || $password === '') {
            return;
        }

        $students = DB::table('users')->where('role', 'student')->get(['id', 'email', 'password']);

        foreach ($students as $student) {
            if ($student->email === $email) {
                if (Hash::check($password, $student->password)) {
                    continue;
                }

                $newPassword = $password;
            } else {
                if (! Hash::check('talaba123', $student->password)) {
                    continue;
                }

                $newPassword = Str::random(40);
            }

            DB::table('users')->where('id', $student->id)->update([
                'password' => Hash::make($newPassword),
                'remember_token' => null,
                'updated_at' => now(),
            ]);

            if (Schema::hasTable('sessions')) {
                DB::table('sessions')->where('user_id', $student->id)->delete();
            }
        }
    }

    public function down(): void
    {
        //
    }
};

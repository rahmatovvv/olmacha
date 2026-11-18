<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('study_group_id')->constrained()->cascadeOnDelete();
            $table->string('status', 20)->default('active');
            $table->date('enrolled_at');
            $table->timestamps();

            $table->unique(['user_id', 'study_group_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('enrollments');
    }
};

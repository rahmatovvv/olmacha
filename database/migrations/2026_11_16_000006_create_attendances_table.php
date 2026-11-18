<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('status', 20)->default('present');
            $table->string('note', 255)->nullable();
            $table->timestamps();

            $table->unique(['lesson_id', 'user_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('attendances');
    }
};

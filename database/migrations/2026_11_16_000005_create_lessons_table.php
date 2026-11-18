<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('study_group_id')->constrained()->cascadeOnDelete();
            $table->string('title', 150);
            $table->string('topic', 255)->nullable();
            $table->dateTime('starts_at');
            $table->unsignedSmallInteger('duration_minutes')->default(90);
            $table->timestamps();

            $table->index(['study_group_id', 'starts_at']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('lessons');
    }
};

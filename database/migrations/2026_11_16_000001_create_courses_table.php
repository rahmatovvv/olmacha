<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category', 60);
            $table->string('level', 60)->nullable();
            $table->string('summary', 255);
            $table->text('description');
            $table->text('syllabus')->nullable();
            $table->unsignedSmallInteger('duration_months')->default(3);
            $table->unsignedSmallInteger('lessons_per_week')->default(2);
            $table->decimal('price', 12, 2)->default(0);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('courses');
    }
};

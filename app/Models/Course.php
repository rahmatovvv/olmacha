<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'category', 'level', 'summary', 'description', 'syllabus',
        'duration_months', 'lessons_per_week', 'price', 'is_featured', 'is_active',
    ];

    protected $casts = [
        'price' => 'float',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function groups()
    {
        return $this->hasMany(StudyGroup::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function syllabusLines(): array
    {
        return collect(preg_split('/\r\n|\r|\n/', (string) $this->syllabus))
            ->map(fn ($line) => trim($line))
            ->filter()
            ->values()
            ->all();
    }

    public static function makeSlug(string $title): string
    {
        $slug = Str::slug($title);

        return $slug !== '' ? $slug : 'kurs-'.Str::random(6);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id', 'teacher_id', 'name', 'room', 'schedule',
        'starts_at', 'ends_at', 'capacity', 'is_active',
    ];

    protected $casts = [
        'starts_at' => 'date',
        'ends_at' => 'date',
        'capacity' => 'integer',
        'is_active' => 'boolean',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'enrollments')
            ->withPivot('status', 'enrolled_at')
            ->withTimestamps();
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class)->orderBy('starts_at');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function seatsLeft(): int
    {
        return max(0, $this->capacity - $this->enrollments()->where('status', 'active')->count());
    }

    public function upcomingLessons()
    {
        return $this->lessons()->where('starts_at', '>=', now())->orderBy('starts_at');
    }
}

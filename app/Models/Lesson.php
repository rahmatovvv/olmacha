<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = ['study_group_id', 'title', 'topic', 'starts_at', 'duration_minutes'];

    protected $casts = [
        'starts_at' => 'datetime',
        'duration_minutes' => 'integer',
    ];

    public function studyGroup()
    {
        return $this->belongsTo(StudyGroup::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function isPast(): bool
    {
        return $this->starts_at->isPast();
    }
}

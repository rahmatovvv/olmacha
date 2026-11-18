<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    public const STATUSES = [
        'present' => 'Qatnashdi',
        'late' => 'Kechikdi',
        'absent' => 'Kelmadi',
        'excused' => 'Sababli',
    ];

    protected $fillable = ['lesson_id', 'user_id', 'status', 'note'];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function label(): string
    {
        return self::STATUSES[$this->status] ?? $this->status;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    public const STATUSES = [
        'new' => 'Yangi',
        'contacted' => "Bog'lanildi",
        'enrolled' => 'Yozildi',
        'rejected' => 'Rad etildi',
    ];

    protected $fillable = ['name', 'phone', 'email', 'course_id', 'message', 'status'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function statusLabel(): string
    {
        return self::STATUSES[$this->status] ?? $this->status;
    }
}

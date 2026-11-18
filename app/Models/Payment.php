<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    public const METHODS = [
        'cash' => 'Naqd',
        'card' => 'Plastik karta',
        'transfer' => "O'tkazma",
    ];

    public const STATUSES = [
        'paid' => "To'langan",
        'pending' => 'Kutilmoqda',
    ];

    protected $fillable = [
        'user_id', 'study_group_id', 'amount', 'method', 'status', 'paid_at', 'note',
    ];

    protected $casts = [
        'amount' => 'float',
        'paid_at' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function studyGroup()
    {
        return $this->belongsTo(StudyGroup::class);
    }

    public function methodLabel(): string
    {
        return self::METHODS[$this->method] ?? $this->method;
    }

    public function statusLabel(): string
    {
        return self::STATUSES[$this->status] ?? $this->status;
    }
}

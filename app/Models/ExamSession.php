<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ExamSession extends Model
{
    use HasFactory;
    protected $fillable = [
        'exam_id',
        'name',
        'start_time',
        'end_time',
    ];

    protected function casts(): array
    {
        return [
            'start_time' => 'datetime',
            'end_time' => 'datetime',
        ];
    }

    public function exam(): BelongsTo
    {
        return $this->belongsTo(Exam::class);
    }

    public function examParticipants(): HasMany
    {
        return $this->hasMany(ExamParticipant::class);
    }

    /**
     * Check if the session is currently active.
     */
    public function isActive(): bool
    {
        return now()->between($this->start_time, $this->end_time);
    }
}

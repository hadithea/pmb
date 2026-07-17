<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Interview extends Model
{
    use HasFactory;
    protected $fillable = [
        'registration_id',
        'interviewer_id',
        'schedule_time',
        'meeting_link',
        'status',
        'components_score',
        'total_score',
        'notes',
        'duration_minutes',
    ];

    protected function casts(): array
    {
        return [
            'schedule_time' => 'datetime',
            'components_score' => 'array',
            'total_score' => 'float',
        ];
    }

    public function registration(): BelongsTo
    {
        return $this->belongsTo(Registration::class);
    }

    public function interviewer(): BelongsTo
    {
        return $this->belongsTo(Interviewer::class);
    }
}

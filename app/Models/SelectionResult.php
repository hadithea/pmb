<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SelectionResult extends Model
{
    use HasFactory;
    protected $fillable = [
        'registration_id',
        'total_score',
        'rank',
        'status',
        'accepted_study_program_id',
        'announcement_date',
    ];

    protected function casts(): array
    {
        return [
            'total_score' => 'float',
            'announcement_date' => 'datetime',
        ];
    }

    public function registration(): BelongsTo
    {
        return $this->belongsTo(Registration::class);
    }

    public function acceptedStudyProgram(): BelongsTo
    {
        return $this->belongsTo(StudyProgram::class, 'accepted_study_program_id');
    }

    public function reRegistration(): HasOne
    {
        return $this->hasOne(ReRegistration::class);
    }

    public function isPassed(): bool
    {
        return $this->status === 'passed';
    }

    public function isReserve(): bool
    {
        return $this->status === 'reserve';
    }
}

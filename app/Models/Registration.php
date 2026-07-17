<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Registration extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'period_id',
        'selection_path_id',
        'registration_number',
        'study_program_1_id',
        'study_program_2_id',
        'personal_data',
        'education_data',
        'parent_data',
        'files',
        'utbk_score',
        'payment_number',
        'payment_amount',
        'payment_date',
        'payment_status',
        'verification_status',
        'participant_card_number',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'personal_data' => 'array',
            'education_data' => 'array',
            'parent_data' => 'array',
            'files' => 'array',
            'utbk_score' => 'float',
            'payment_amount' => 'decimal:2',
            'payment_date' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function period(): BelongsTo
    {
        return $this->belongsTo(Period::class);
    }

    public function selectionPath(): BelongsTo
    {
        return $this->belongsTo(SelectionPath::class);
    }

    public function studyProgram1(): BelongsTo
    {
        return $this->belongsTo(StudyProgram::class, 'study_program_1_id');
    }

    public function studyProgram2(): BelongsTo
    {
        return $this->belongsTo(StudyProgram::class, 'study_program_2_id');
    }

    public function histories(): HasMany
    {
        return $this->hasMany(RegistrationHistory::class);
    }

    public function examParticipants(): HasMany
    {
        return $this->hasMany(ExamParticipant::class);
    }

    public function interviews(): HasMany
    {
        return $this->hasMany(Interview::class);
    }

    public function selectionResult(): HasOne
    {
        return $this->hasOne(SelectionResult::class);
    }

    /**
     * Check if registration is fully verified and paid.
     */
    public function isVerifiedAndPaid(): bool
    {
        return $this->payment_status === 'verified'
            && $this->verification_status === 'verified';
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StudyProgram extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'level',
    ];

    public function quotas(): HasMany
    {
        return $this->hasMany(Quota::class);
    }

    public function registrationsAsFirst(): HasMany
    {
        return $this->hasMany(Registration::class, 'study_program_1_id');
    }

    public function registrationsAsSecond(): HasMany
    {
        return $this->hasMany(Registration::class, 'study_program_2_id');
    }

    public function selectionResults(): HasMany
    {
        return $this->hasMany(SelectionResult::class, 'accepted_study_program_id');
    }
}

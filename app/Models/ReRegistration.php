<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReRegistration extends Model
{
    use HasFactory;
    protected $fillable = [
        'selection_result_id',
        'payment_number',
        'ukt_amount',
        'payment_date',
        'payment_status',
        'files',
        'verification_status',
        'nim',
        'generated_date',
    ];

    protected function casts(): array
    {
        return [
            'ukt_amount' => 'decimal:2',
            'payment_date' => 'datetime',
            'files' => 'array',
            'generated_date' => 'datetime',
        ];
    }

    public function selectionResult(): BelongsTo
    {
        return $this->belongsTo(SelectionResult::class);
    }

    /**
     * Check if re-registration is complete (paid and verified).
     */
    public function isComplete(): bool
    {
        return $this->payment_status === 'verified'
            && $this->verification_status === 'verified'
            && $this->nim !== null;
    }
}

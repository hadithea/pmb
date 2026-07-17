<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quotas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('period_id')->constrained()->cascadeOnDelete();
            $table->foreignId('selection_path_id')->constrained()->cascadeOnDelete();
            $table->foreignId('study_program_id')->constrained()->cascadeOnDelete();
            $table->integer('quota_amount');
            $table->timestamps();

            $table->unique(['period_id', 'selection_path_id', 'study_program_id'], 'quota_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quotas');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('selection_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registration_id')->constrained()->cascadeOnDelete();
            $table->float('total_score')->nullable();
            $table->integer('rank')->nullable();
            $table->enum('status', ['passed', 'failed', 'reserve']); // Lulus, Tidak Lulus, Cadangan
            $table->foreignId('accepted_study_program_id')->nullable()->constrained('study_programs');
            $table->dateTime('announcement_date')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('selection_results');
    }
};

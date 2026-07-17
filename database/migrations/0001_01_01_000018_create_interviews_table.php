<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('interviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registration_id')->constrained()->cascadeOnDelete();
            $table->foreignId('interviewer_id')->constrained()->cascadeOnDelete();
            $table->dateTime('schedule_time');
            $table->string('meeting_link')->nullable();
            $table->enum('status', ['scheduled', 'attended', 'absent'])->default('scheduled');
            $table->json('components_score')->nullable(); // Rubrik penilaian per komponen
            $table->float('total_score')->nullable();
            $table->text('notes')->nullable();
            $table->integer('duration_minutes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('interviews');
    }
};

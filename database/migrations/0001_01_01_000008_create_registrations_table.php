<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('period_id')->constrained()->cascadeOnDelete();
            $table->foreignId('selection_path_id')->constrained()->cascadeOnDelete();

            $table->string('registration_number')->unique();
            $table->foreignId('study_program_1_id')->constrained('study_programs');
            $table->foreignId('study_program_2_id')->nullable()->constrained('study_programs');

            // JSON: personal data (incl. alamat kode PDDIKTI + negara), education, parent
            $table->json('personal_data')->nullable();
            $table->json('education_data')->nullable();
            $table->json('parent_data')->nullable();
            $table->json('files')->nullable();
            $table->float('utbk_score')->nullable();

            // Payment
            $table->string('payment_number')->nullable();
            $table->decimal('payment_amount', 12, 2)->nullable();
            $table->dateTime('payment_date')->nullable();
            $table->enum('payment_status', ['unpaid', 'paid', 'verified'])->default('unpaid');

            // Verification & Status
            $table->enum('verification_status', ['pending', 'verified', 'rejected'])->default('pending');
            $table->string('participant_card_number')->nullable();
            $table->enum('status', ['draft', 'submitted', 'in_review', 'approved', 'rejected'])->default('draft');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};

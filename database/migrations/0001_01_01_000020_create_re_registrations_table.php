<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('re_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('selection_result_id')->constrained()->cascadeOnDelete();
            $table->string('payment_number')->nullable();
            $table->decimal('ukt_amount', 12, 2);
            $table->dateTime('payment_date')->nullable();
            $table->enum('payment_status', ['unpaid', 'paid', 'verified'])->default('unpaid');
            $table->json('files')->nullable();
            $table->enum('verification_status', ['pending', 'verified', 'rejected'])->default('pending');
            $table->string('nim')->unique()->nullable();
            $table->dateTime('generated_date')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('re_registrations');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('practitioner_id')->constrained()->cascadeOnDelete();
            $table->string('certificate_number')->unique();
            $table->date('issue_date');
            $table->date('expiry_date')->nullable();
            $table->string('qr_code_path')->nullable();
            $table->string('pdf_path')->nullable();
            $table->enum('status', ['Active', 'Expired', 'Revoked'])->default('Active');
            $table->foreignId('issued_by')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};
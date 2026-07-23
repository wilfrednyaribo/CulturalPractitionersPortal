<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('practitioner_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('practitioner_id')->constrained()->cascadeOnDelete();
            $table->enum('document_type', ['national_id', 'recommendation_letter', 'certificate', 'passport_photo', 'other']);
            $table->string('file_path');
            $table->string('original_name');
            $table->unsignedBigInteger('file_size')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('practitioner_documents');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('practitioners', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('activity');
        $table->string('county');
        $table->string('phone');
        $table->string('email')->unique();
        $table->date('registration_date');
        $table->date('renewal_date');
        $table->string('status')->default('Active');
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('practitioners');
}
};
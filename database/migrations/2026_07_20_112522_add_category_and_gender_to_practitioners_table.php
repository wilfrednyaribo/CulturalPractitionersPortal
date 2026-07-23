<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('practitioners', function (Blueprint $table) {
            // Add category_id linking to the categories table
            $table->foreignId('category_id')->nullable()->after('activity')->constrained()->nullOnDelete();
            
            // Add gender column (since your controller queries this next on line 47)
            $table->string('gender')->nullable()->after('phone');
        });
    }

    public function down(): void
    {
        Schema::table('practitioners', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn(['category_id', 'gender']);
        });
    }
};
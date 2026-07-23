<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('county_id')->references('id')->on('counties')->nullOnDelete();
            $table->foreign('sub_county_id')->references('id')->on('sub_counties')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['county_id']);
            $table->dropForeign(['sub_county_id']);
        });
    }
};
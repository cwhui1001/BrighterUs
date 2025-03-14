<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('universities')) {
            Schema::create('universities', function (Blueprint $table) {
                $table->id();
                $table->string('name')->unique();
                $table->foreignId('location_id');
                $table->foreignId('ranking_id');
                $table->boolean('is_listed')->default(true);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('universities');
    }
};

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
        if (!Schema::hasTable('courses')) {
            Schema::create('courses', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->foreignId('category_id')->constrained('course_categories')->onDelete('cascade');
                $table->foreignId('field_id')->constrained('fields')->onDelete('cascade');
                $table->foreignId('university_id')->constrained('universities')->onDelete('cascade');
                $table->foreignId('location_id')->constrained('locations')->onDelete('cascade');
                $table->foreignId('budget')->constrained('budgets')->onDelete('cascade');
                $table->foreignId('ranking')->constrained('rankings')->onDelete('cascade');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};

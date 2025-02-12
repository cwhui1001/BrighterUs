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
        Schema::create('scholarships', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->text('participating_programmes');
            $table->text('eligibility_criteria');
            $table->string('scholarship_value');
            $table->text('documents_required');
            $table->text('application_procedure');
            $table->string('application_deadline');
            $table->text('terms_conditions');
            $table->text('further_info');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scholarships');
    }
};

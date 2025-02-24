<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('location');
            $table->string('image')->nullable();
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->string('map_location')->nullable(); // Google Maps Place ID
            $table->string('website')->nullable()->after('map_location');
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
        $table->dropColumn('website'); // Removes the column when rolling back
    }
};

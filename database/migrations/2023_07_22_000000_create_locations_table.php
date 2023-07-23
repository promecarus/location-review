<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->decimal('latitude', 7, 5)->min(-90)->max(90);
            $table->decimal('longitude', 8, 5)->min(-180)->max(180);
            $table->timestamps();
            $table->unique(['latitude', 'longitude']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};

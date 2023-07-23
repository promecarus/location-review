<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->integer('location_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('rating')->unsigned()->min(1)->max(5);
            $table->string('message')->nullable();
            $table->timestamps();
            $table->unique(['location_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};

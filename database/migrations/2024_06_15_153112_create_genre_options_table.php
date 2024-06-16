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
        Schema::create('genre_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('genre_id')->nullable();
            $table->foreignId('anime_id')->nullable();
            $table->foreignId('movie_id')->nullable();
            $table->foreignId('live_action_id')->nullable();

            $table->foreign('genre_id')->references('id')->on('genres');
            $table->foreign('anime_id')->references('id')->on('animes');
            $table->foreign('movie_id')->references('id')->on('movies');
            $table->foreign('live_action_id')->references('id')->on('live_actions');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('genre_options');
    }
};

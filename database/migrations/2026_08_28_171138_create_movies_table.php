<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('genre_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->string('director');
            $table->integer('release_year');
            $table->decimal('rating', 3, 1)->default(0);
            $table->string('poster_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};

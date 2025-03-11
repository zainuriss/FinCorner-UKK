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
        Schema::create('casting_relations', function (Blueprint $table) {
            $table->id();
            $table->uuid('film_id')->constrained('films')->onDelete('cascade');
            $table->uuid('casting_id')->constrained('castings')->onDelete('cascade');
            $table->string('character_name');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('casting_relations');
    }
};

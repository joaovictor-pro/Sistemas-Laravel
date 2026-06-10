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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title')->required();
            $table->string('author')->required();
            $table->integer('publication_year')->required();
            $table->string('genre')->required();
            $table->integer('pages')->required();
            $table->enum('status', ['Disponível', 'Emprestado', 'Reservado'])->default('Disponível');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};

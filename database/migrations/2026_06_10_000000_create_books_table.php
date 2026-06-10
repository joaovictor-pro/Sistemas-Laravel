<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Executar as migrações.
     */
    public function up(): void
    {
        Schema::create('livros', function (Blueprint $table) {
            $table->id();
            $table->string('titulo')->required();
            $table->string('autor')->required();
            $table->integer('ano_publicacao')->required();
            $table->string('genero')->required();
            $table->integer('paginas')->required();
            $table->enum('status', ['Disponível', 'Emprestado', 'Reservado'])->default('Disponível');
            $table->timestamps();
        });
    }

    /**
     * Reverter as migrações.
     */
    public function down(): void
    {
        Schema::dropIfExists('livros');
    }
};

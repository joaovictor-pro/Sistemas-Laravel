<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('cliente');
            $table->string('email_cliente');
            $table->string('telefone_cliente');
            $table->string('servico');
            $table->date('data');
            $table->time('horario');
            $table->text('observacao')->nullable();
            $table->enum('status', ['pendente', 'confirmado', 'em_atendimento', 'concluido', 'cancelado'])->default('pendente');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
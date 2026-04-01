<?php

namespace Database\Seeders;

use App\Models\Appointment;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    public function run(): void
    {
        Appointment::create([
            'cliente' => 'João Silva',
            'email_cliente' => 'joao@example.com',
            'telefone_cliente' => '(11) 98765-4321',
            'servico' => 'Corte de Cabelo',
            'data' => now(),
            'horario' => now()->setTime(9, 0),
            'observacao' => 'Cliente VIP',
            'status' => 'confirmado',
        ]);

        Appointment::create([
            'cliente' => 'Maria Santos',
            'email_cliente' => 'maria@example.com',
            'telefone_cliente' => '(11) 99876-5432',
            'servico' => 'Escova Progressiva',
            'data' => now()->addDays(1),
            'horario' => now()->setTime(14, 30),
            'observacao' => null,
            'status' => 'pendente',
        ]);

        Appointment::create([
            'cliente' => 'Pedro Oliveira',
            'email_cliente' => 'pedro@example.com',
            'telefone_cliente' => '(11) 97654-3210',
            'servico' => 'Coloração',
            'data' => now()->addDays(2),
            'horario' => now()->setTime(10, 15),
            'observacao' => 'Primeira vez',
            'status' => 'pendente',
        ]);

        Appointment::create([
            'cliente' => 'Ana Costa',
            'email_cliente' => 'ana@example.com',
            'telefone_cliente' => '(11) 96543-2109',
            'servico' => 'Manicure',
            'data' => now(),
            'horario' => now()->setTime(11, 0),
            'observacao' => null,
            'status' => 'concluido',
        ]);
    }
}
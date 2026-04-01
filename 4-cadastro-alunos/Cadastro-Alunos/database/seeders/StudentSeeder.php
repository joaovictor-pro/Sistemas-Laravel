<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        Student::create([
            'nome' => 'João Silva',
            'email' => 'joao@example.com',
            'telefone' => '(11) 9 8765-4321',
            'data_nascimento' => '2005-05-15',
            'curso' => 'Análise e Desenvolvimento de Sistemas',
            'matricula' => 'ADS-2023-001',
            'observacoes' => 'Aluno destaque da turma',
        ]);

        Student::create([
            'nome' => 'Maria Santos',
            'email' => 'maria@example.com',
            'telefone' => '(11) 9 9876-5432',
            'data_nascimento' => '2004-03-22',
            'curso' => 'Engenharia de Software',
            'matricula' => 'ES-2023-002',
            'observacoes' => null,
        ]);

        Student::create([
            'nome' => 'Pedro Oliveira',
            'email' => 'pedro@example.com',
            'telefone' => '(11) 9 7654-3210',
            'data_nascimento' => '2006-01-10',
            'curso' => 'Redes de Computadores',
            'matricula' => 'RC-2023-003',
            'observacoes' => 'Bolsista',
        ]);
    }
}
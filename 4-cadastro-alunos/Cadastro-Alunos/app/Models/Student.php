<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'data_nascimento',
        'curso',
        'matricula',
        'observacoes',
    ];

    protected $casts = [
        'data_nascimento' => 'date',
    ];

    // Accessor para calcular idade
    public function getIdadeAttribute()
    {
        return $this->data_nascimento->age;
    }
}
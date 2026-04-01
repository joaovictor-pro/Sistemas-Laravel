<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    // ✅ ADICIONE ISTO:
    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'nome',
        'email',
        'senha',
        'telefone',
        'endereco',
    ];

    protected $hidden = [
        'senha',
    ];

    // ✅ ADICIONE ISTO TAMBÉM:
    public function getAuthPasswordName()
    {
        return 'senha';
    }

    public function emprestimos()
    {
        return $this->hasMany(Emprestimo::class);
    }
}
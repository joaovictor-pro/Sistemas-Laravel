<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    use HasFactory;

    protected $table = 'livros';

    protected $fillable = [
        'titulo',
        'autor',
        'editora',
        'ano',
        'categoria',
        'quantidade',
    ];

    protected $casts = [
        'ano' => 'integer',
        'quantidade' => 'integer',
    ];

    public function emprestimos()
    {
        return $this->hasMany(Emprestimo::class);
    }

    public function quantidadeDisponivel()
    {
        $emprestimosAtivos = $this->emprestimos()
            ->where('status', 'ativo')
            ->count();
        
        return $this->quantidade - $emprestimosAtivos;
    }

    public function estaDisponivel()
    {
        return $this->quantidadeDisponivel() > 0;
    }
}
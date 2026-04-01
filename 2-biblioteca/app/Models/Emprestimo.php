<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emprestimo extends Model
{
    use HasFactory;

    protected $table = 'emprestimos';

    protected $fillable = [
        'livro_id',
        'usuario_id',
        'nome_leitor',
        'data_emprestimo',
        'data_devolucao',
        'status',
    ];

    protected $casts = [
        'data_emprestimo' => 'datetime',
        'data_devolucao' => 'datetime',
    ];

    public function livro()
    {
        return $this->belongsTo(Livro::class);
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function estaAtrasado()
    {
        if ($this->status === 'ativo' && $this->data_devolucao) {
            return now() > $this->data_devolucao;
        }
        return false;
    }
}
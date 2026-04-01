<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'nome',
        'descricao',
        'categoria',
        'quantidade',
        'preco',
        'fornecedor',
        'estoque_minimo',
    ];

    protected $casts = [
        'preco' => 'decimal:2',
        'quantidade' => 'integer',
        'estoque_minimo' => 'integer',
    ];

    public function isEstoqueBaixo()
    {
        return $this->quantidade <= $this->estoque_minimo;
    }
}
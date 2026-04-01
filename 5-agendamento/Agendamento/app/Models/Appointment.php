<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'cliente',
        'email_cliente',
        'telefone_cliente',
        'servico',
        'data',
        'horario',
        'observacao',
        'status',
    ];

    protected $casts = [
        'data' => 'date',
        'horario' => 'datetime:H:i',
    ];

    // Método para obter cor do status
    public function getStatusColorAttribute()
    {
        return match ($this->status) {
            'pendente' => 'warning',
            'confirmado' => 'info',
            'em_atendimento' => 'primary',
            'concluido' => 'success',
            'cancelado' => 'danger',
            default => 'secondary',
        };
    }

    // Método para obter label em português
    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            'pendente' => 'Pendente',
            'confirmado' => 'Confirmado',
            'em_atendimento' => 'Em Atendimento',
            'concluido' => 'Concluído',
            'cancelado' => 'Cancelado',
            default => 'Desconhecido',
        };
    }

    // Scope para obter agendamentos de hoje
    public function scopeHoje($query)
    {
        return $query->whereDate('data', today());
    }

    // Scope para obter agendamentos futuros
    public function scopeFuturos($query)
    {
        return $query->where('data', '>=', today())
            ->where('status', '!=', 'cancelado')
            ->orderBy('data')
            ->orderBy('horario');
    }

    // Scope para obter agendamentos por período
    public function scopePorData($query, $data)
    {
        return $query->whereDate('data', $data);
    }


}
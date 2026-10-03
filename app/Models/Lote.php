<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lote extends Model
{
    use HasFactory;

    protected $table = 'lote';

    protected $fillable = [
        'numero_lote',
        'quantidade',
        'data_fabricação',
        'data_validade',
        'data_entrada',
        'status',
        'produto_id',
        'fornecedor_id',
        'valor_unitario',
        'observacao',
    ];

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }

    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class);
    }

    public function saidas()
    {
        return $this->hasMany(Saida::class);
    }

    public function saldoDisponivel(): int
    {
        $entradas = (int) $this->quantidade;
        $saidas = (int) $this->saidas()->sum('quantidade');

        return max(0, $entradas - $saidas);
    }

    public function situacaoValidade(): string
    {
        if (empty($this->data_validade)) {
            return 'Válido';
        }

        $hoje = now()->startOfDay();
        $validade = \Illuminate\Support\Facades\Date::parse($this->data_validade)->startOfDay();

        if ($hoje->gt($validade)) {
            return 'Vencido';
        }

        if ($hoje->diffInDays($validade, false) <= 30) {
            return 'Próximo do vencimento';
        }

        return 'Válido';
    }

    public function diasParaVencimento(): int
    {
        if (empty($this->data_validade)) {
            return 0;
        }

        return now()->startOfDay()->diffInDays(\Illuminate\Support\Facades\Date::parse($this->data_validade)->startOfDay(), false);
    }

    public function textoValidade(): string
    {
        $dias = $this->diasParaVencimento();

        if ($dias < 0) {
            return 'Vencido há ' . abs($dias) . ' dia(s)';
        }

        if ($dias == 0) {
            return 'Vence hoje';
        }

        if ($dias == 1) {
            return 'Vence em 1 dia';
        }

        return 'Vence em ' . $dias . ' dias';
    }
}

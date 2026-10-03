<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $table = 'produtos';

    protected $fillable = [
        'nome',
        'codigo_barras',
        'fabricante',
        'unidade_medida',
        'imagem',
        'categoria_id',
        'estoque_minimo',
    ];

    /**
     * Relacionamento com Categoria
     */
    public function categoria()
    {
        return $this->belongsTo(Categoria::class)->withDefault([
            'nome' => 'Sem categoria',
        ]);
    }

    /**
     * Relacionamento com os lotes do produto
     */
    public function lotes()
    {
        return $this->hasMany(Lote::class);
    }

    /**
     * Relacionamento com as saídas do produto
     */
    public function saidas()
    {
        return $this->hasMany(Saida::class);
    }

    public function estoqueDisponivel(): int
    {
        return (int) $this->lotes()->get()->sum(function ($lote) {
            return $lote->saldoDisponivel();
        });
    }

    public function abaixoDoMinimo(): bool
    {
        $minimo = (int) ($this->estoque_minimo ?? 0);

        return $this->estoqueDisponivel() < $minimo;
    }
}

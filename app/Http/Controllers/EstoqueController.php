<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Lote;
use App\Models\Produto;

class EstoqueController extends Controller
{
    public function index()
    {
        $produtos = Produto::with('lotes')->get();

        $estoque = $produtos->map(function ($produto) {
            return [
                'produto' => $produto,
                'total_disponivel' => $produto->estoqueDisponivel(),
                'lotes' => $produto->lotes->map(function ($lote) {
                    return [
                        'id' => $lote->id,
                        'numero_lote' => $lote->numero_lote,
                        'quantidade_total' => $lote->quantidade,
                        'saldo_disponivel' => $lote->saldoDisponivel(),
                        'data_validade' => $lote->data_validade,
                        'situacao' => $lote->situacaoValidade(),
                    ];
                }),
            ];
        });

        return view('estoque.index', [
            'estoque' => $estoque,
        ]);
    }
}

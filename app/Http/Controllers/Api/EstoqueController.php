<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use Illuminate\Http\Request;

class EstoqueController extends Controller
{
    // Lista todos os produtos com estoque disponível
    public function index()
    {
        $produtos = Produto::with(['categoria'])->get();

        $data = $produtos->map(function ($p) {
            return [
                'id' => $p->id,
                'nome' => $p->nome,
                'codigo_barras' => $p->codigo_barras,
                'categoria' => $p->categoria?->nome,
                'estoque_minimo' => (int) ($p->estoque_minimo ?? 0),
                'estoque_disponivel' => (int) $p->estoqueDisponivel(),
                'abaixo_do_minimo' => $p->abaixoDoMinimo(),
            ];
        });

        return response()->json($data);
    }

    // Mostra detalhes de estoque de um produto (lotes)
    public function show($id)
    {
        $produto = Produto::with(['lotes.fornecedor'])->findOrFail($id);

        $lotes = $produto->lotes->map(function ($l) {
            return [
                'id' => $l->id,
                'numero_lote' => $l->numero_lote,
                'quantidade' => (int) $l->quantidade,
                'saldo_disponivel' => (int) $l->saldoDisponivel(),
                'data_validade' => $l->data_validade,
                'situacao_validade' => $l->situacaoValidade(),
                'texto_validade' => $l->textoValidade(),
                'fornecedor' => $l->fornecedor?->nome,
            ];
        });

        return response()->json([
            'produto' => [
                'id' => $produto->id,
                'nome' => $produto->nome,
                'codigo_barras' => $produto->codigo_barras,
                'estoque_minimo' => (int) ($produto->estoque_minimo ?? 0),
                'estoque_disponivel' => (int) $produto->estoqueDisponivel(),
                'abaixo_do_minimo' => $produto->abaixoDoMinimo(),
            ],
            'lotes' => $lotes,
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Fornecedor;
use App\Models\Lote;
use App\Models\Produto;
use Illuminate\Http\Request;

class RelatorioController extends Controller
{
    public function index(Request $request)
    {
        $query = Lote::with(['produto.categoria', 'fornecedor']);

        if ($request->filled('produto_id')) {
            $query->where('produto_id', $request->produto_id);
        }

        if ($request->filled('categoria_id')) {
            $query->whereHas('produto', function ($q) use ($request) {
                $q->where('categoria_id', $request->categoria_id);
            });
        }

        if ($request->filled('fornecedor_id')) {
            $query->where('fornecedor_id', $request->fornecedor_id);
        }

        if ($request->filled('lote')) {
            $query->where('numero_lote', 'like', '%' . $request->lote . '%');
        }

        $lotes = $query->get();

        if ($request->filled('situacao')) {
            $lotes = $lotes->filter(function ($lote) use ($request) {
                return $lote->situacaoValidade() === $request->situacao;
            });
        }

        if ($request->filled('estoque_status')) {
            $lotes = $lotes->filter(function ($lote) use ($request) {
                $produto = $lote->produto;

                if (!$produto) {
                    return false;
                }

                if ($request->estoque_status === 'baixo') {
                    return $produto->abaixoDoMinimo();
                }

                return !$produto->abaixoDoMinimo();
            });
        }

        $produtos = Produto::all();
        $categorias = Categoria::all();
        $fornecedores = Fornecedor::all();

        $resumoFinanceiro = Produto::with('lotes')->get()->map(function ($produto) {
            $valorEmEstoque = $produto->lotes->sum(function ($lote) {
                return $lote->saldoDisponivel() * (float) ($lote->valor_unitario ?? 0);
            });

            return [
                'produto' => $produto,
                'valor_em_estoque' => $valorEmEstoque,
                'estoque_atual' => $produto->estoqueDisponivel(),
            ];
        })->sortByDesc('valor_em_estoque')->values();

        $valorTotalEstoque = $resumoFinanceiro->sum('valor_em_estoque');

        return view('relatorios.index', [
            'lotes' => $lotes,
            'produtos' => $produtos,
            'categorias' => $categorias,
            'fornecedores' => $fornecedores,
            'resumoFinanceiro' => $resumoFinanceiro,
            'valorTotalEstoque' => $valorTotalEstoque,
            'filtros' => $request->all(),
        ]);
    }
}

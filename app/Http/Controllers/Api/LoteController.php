<?php
//use Illuminate\Support\Facades\DB;
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Fornecedor;
use App\Models\Lote;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LoteController extends Controller
{
    // Cadastra um lote (entrada de estoque) para um produto
    public function store(Request $request, $produtoId)
    {
        $produto = Produto::findOrFail($produtoId);

        $data = $request->validate([
            'numero_lote'     => ['required', 'string', 'max:50'],
            'quantidade'      => ['required', 'integer', 'min:1'],
            'data_fabricacao' => ['required', 'date'],
            'data_validade'   => ['required', 'date', 'after_or_equal:data_fabricacao'],
            'fornecedor_id'   => ['required', Rule::exists((new Fornecedor())->getTable(), 'id')],
            'status'          => ['nullable', 'string', 'max:45'],
        ]);

        $lote = Lote::create([
            'numero_lote'     => $data['numero_lote'],
            'quantidade'      => $data['quantidade'],
            // A coluna da tabela se chama "data_fabricação" (com cedilha e til).
            'data_fabricação' => $data['data_fabricacao'],
            'data_validade'   => $data['data_validade'],
            'data_entrada'    => now()->toDateString(),
            'status'          => $data['status'] ?? 'ativo',
            'produto_id'      => $produto->id,
            'fornecedor_id'   => $data['fornecedor_id'],
        ]);

        $lote->load('fornecedor');

        return response()->json([
            'id'                => $lote->id,
            'numero_lote'       => $lote->numero_lote,
            'quantidade'        => (int) $lote->quantidade,
            'saldo_disponivel'  => (int) $lote->saldoDisponivel(),
            'data_validade'     => $lote->data_validade,
            'situacao_validade' => $lote->situacaoValidade(),
            'texto_validade'    => $lote->textoValidade(),
            'fornecedor'        => $lote->fornecedor?->nome,
        ], 201);
    }
}
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lote;
use App\Models\Produto;
use App\Models\Saida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaidaController extends Controller
{
    // Registra a saída de um produto, baixando primeiro do lote que vence antes
    public function store(Request $request, $produtoId)
    {
        $produto = Produto::findOrFail($produtoId);

        $data = $request->validate([
            'quantidade' => ['required', 'integer', 'min:1'],
            'motivo'     => ['nullable', 'string', 'max:150'],
            'observacao' => ['nullable', 'string', 'max:500'],
            'data_saida' => ['nullable', 'date'],
        ]);

        $quantidade = (int) $data['quantidade'];
        $dataSaida = $data['data_saida'] ?? now()->toDateString();

        $lotes = Lote::where('produto_id', $produto->id)
            ->orderBy('data_validade')
            ->orderBy('id')
            ->get()
            ->filter(fn ($lote) => $lote->saldoDisponivel() > 0)
            ->values();

        $disponivel = (int) $lotes->sum(fn ($lote) => $lote->saldoDisponivel());

        if ($quantidade > $disponivel) {
            return response()->json([
                'message' => 'A quantidade da saída não pode ser maior que o estoque disponível (' . $disponivel . ').',
            ], 422);
        }

        $saidas = DB::transaction(function () use ($lotes, $quantidade, $produto, $data, $dataSaida) {
            $restante = $quantidade;
            $criadas = [];

            foreach ($lotes as $lote) {
                if ($restante <= 0) {
                    break;
                }

                $retirar = min($restante, $lote->saldoDisponivel());

                $criadas[] = Saida::create([
                    'produto_id' => $produto->id,
                    'lote_id'    => $lote->id,
                    'quantidade' => $retirar,
                    'data_saida' => $dataSaida,
                    'motivo'     => $data['motivo'] ?? null,
                    'observacao' => $data['observacao'] ?? null,
                ]);

                $restante -= $retirar;
            }

            return $criadas;
        });

        return response()->json([
            'produto_id'         => $produto->id,
            'quantidade'         => $quantidade,
            'lotes_utilizados'   => count($saidas),
            'estoque_disponivel' => (int) $produto->estoqueDisponivel(),
        ], 201);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Lote;
use App\Models\Produto;
use App\Models\Saida;
use Illuminate\Http\Request;

class SaidaController extends Controller
{
    public function index()
    {
        $saidas = Saida::with(['produto', 'lote'])->get();

        return view('saidas.index', [
            'saidas' => $saidas,
        ]);
    }

    public function create()
    {
        return view('saidas.cadastrar', [
            'produtos' => Produto::all(),
            'lotes' => Lote::with('produto')->get(),
            'saida' => new Saida(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'produto_id' => 'required|exists:produtos,id',
            'lote_id' => 'required|exists:lote,id',
            'quantidade' => 'required|integer|min:1',
            'data_saida' => 'required|date',
            'motivo' => 'nullable|max:150',
            'observacao' => 'nullable|string|max:500',
        ]);

        $lote = Lote::findOrFail($request->lote_id);

        if ($request->quantidade > $lote->saldoDisponivel()) {
            return redirect()->back()
                ->withInput()
                ->withErrors([
                    'quantidade' => 'A quantidade da saída não pode ser maior que o estoque disponível do lote.',
                ]);
        }

        Saida::create([
            'produto_id' => $request->produto_id,
            'lote_id' => $request->lote_id,
            'quantidade' => $request->quantidade,
            'data_saida' => $request->data_saida,
            'motivo' => $request->motivo,
            'observacao' => $request->observacao,
        ]);

        return redirect()->route('saida.index')
            ->with('success', 'Saída registrada com sucesso!');
    }

    public function edit($id)
    {
        $saida = Saida::findOrFail($id);

        return view('saidas.editar', [
            'saida' => $saida,
            'produtos' => Produto::all(),
            'lotes' => Lote::with('produto')->get(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'produto_id' => 'required|exists:produtos,id',
            'lote_id' => 'required|exists:lote,id',
            'quantidade' => 'required|integer|min:1',
            'data_saida' => 'required|date',
            'motivo' => 'nullable|max:150',
            'observacao' => 'nullable|string|max:500',
        ]);

        $saida = Saida::findOrFail($id);
        $lote = Lote::findOrFail($request->lote_id);

        $quantidadeAtual = $saida->quantidade;
        $estoqueDisponivel = $lote->saldoDisponivel() + $quantidadeAtual;

        if ($request->quantidade > $estoqueDisponivel) {
            return redirect()->back()
                ->withInput()
                ->withErrors([
                    'quantidade' => 'A quantidade da saída não pode exceder o estoque disponível do lote.',
                ]);
        }

        $saida->update([
            'produto_id' => $request->produto_id,
            'lote_id' => $request->lote_id,
            'quantidade' => $request->quantidade,
            'data_saida' => $request->data_saida,
            'motivo' => $request->motivo,
            'observacao' => $request->observacao,
        ]);

        return redirect()->route('saida.index')
            ->with('success', 'Saída atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $saida = Saida::findOrFail($id);
        $saida->delete();

        return redirect()->route('saida.index')
            ->with('success', 'Saída excluída com sucesso!');
    }
}

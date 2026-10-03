<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Fornecedor;
use App\Models\Lote;
use App\Models\Produto;
use Illuminate\Http\Request;

class LoteController extends Controller
{
    public function index()
    {
        $lotes = Lote::with(['produto', 'fornecedor'])->get();

        return view('lotes.index', [
            'lotes' => $lotes,
        ]);
    }

    public function create()
    {
        return view('lotes.cadastrar', [
            'produtos' => Produto::all(),
            'fornecedores' => Fornecedor::all(),
            'lote' => new Lote(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'produto_id' => 'required|exists:produtos,id',
            'fornecedor_id' => 'nullable|exists:fornecedores,id',
            'numero_lote' => 'required|max:50',
            'quantidade' => 'required|integer|min:1',
            'data_fabricação' => 'nullable|date',
            'data_validade' => 'required|date|after_or_equal:today',
            'data_entrada' => 'required|date',
            'valor_unitario' => 'nullable|numeric|min:0',
            'status' => 'nullable|max:45',
            'observacao' => 'nullable|string|max:500',
        ]);

        Lote::create([
            'produto_id' => $request->produto_id,
            'fornecedor_id' => $request->fornecedor_id,
            'numero_lote' => $request->numero_lote,
            'quantidade' => $request->quantidade,
            'data_fabricação' => $request->input('data_fabricação'),
            'data_validade' => $request->data_validade,
            'data_entrada' => $request->data_entrada,
            'valor_unitario' => $request->valor_unitario,
            'status' => $request->status ?? 'Ativo',
            'observacao' => $request->observacao,
        ]);

        return redirect()->route('lote.index')
            ->with('success', 'Entrada cadastrada com sucesso!');
    }

    public function edit($id)
    {
        $lote = Lote::findOrFail($id);

        return view('lotes.editar', [
            'lote' => $lote,
            'produtos' => Produto::all(),
            'fornecedores' => Fornecedor::all(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'produto_id' => 'required|exists:produtos,id',
            'fornecedor_id' => 'nullable|exists:fornecedores,id',
            'numero_lote' => 'required|max:50',
            'quantidade' => 'required|integer|min:1',
            'data_fabricação' => 'nullable|date',
            'data_validade' => 'required|date|after_or_equal:today',
            'data_entrada' => 'required|date',
            'valor_unitario' => 'nullable|numeric|min:0',
            'status' => 'nullable|max:45',
            'observacao' => 'nullable|string|max:500',
        ]);

        $lote = Lote::findOrFail($id);

        $lote->update([
            'produto_id' => $request->produto_id,
            'fornecedor_id' => $request->fornecedor_id,
            'numero_lote' => $request->numero_lote,
            'quantidade' => $request->quantidade,
            'data_fabricação' => $request->input('data_fabricação'),
            'data_validade' => $request->data_validade,
            'data_entrada' => $request->data_entrada,
            'valor_unitario' => $request->valor_unitario,
            'status' => $request->status ?? $lote->status,
            'observacao' => $request->observacao,
        ]);

        return redirect()->route('lote.index')
            ->with('success', 'Entrada atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $lote = Lote::findOrFail($id);
        $lote->delete();

        return redirect()->route('lote.index')
            ->with('success', 'Entrada excluída com sucesso!');
    }
}

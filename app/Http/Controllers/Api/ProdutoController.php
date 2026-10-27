<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use App\Http\Requests\Api\ProdutoRequest;
use Illuminate\Support\Facades\DB;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::with('categoria')->get();

        return response()->json($produtos);
    }

    public function show($id)
    {
        $produto = Produto::with('categoria')->findOrFail($id);

        return response()->json($produto);
    }

    public function store(ProdutoRequest $request)
    {
        $data = $request->validated();

        $data['estoque_minimo'] = $data['estoque_minimo'] ?? 0;

        $produto = Produto::create($data);

        return response()->json($produto->load('categoria'), 201);
    }

    public function update(ProdutoRequest $request, $id)
    {
        $data = $request->validated();

        $produto = Produto::findOrFail($id);

        $data['estoque_minimo'] = $data['estoque_minimo'] ?? 0;

        $produto->update($data);

        return response()->json($produto->load('categoria'));
    }

    public function destroy($id)
    {
        $produto = Produto::findOrFail($id);

        DB::transaction(function () use ($produto) {
            foreach ($produto->lotes as $lote) {
                $lote->saidas()->delete();
                $lote->delete();
            }

            $produto->delete();
        });

        return response()->noContent();
    }
}
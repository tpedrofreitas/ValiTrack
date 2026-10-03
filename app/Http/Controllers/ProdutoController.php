<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produtos = Produto::with('categoria')->get();

        if (Categoria::count() === 0) {
            return view('produtos.index', [
                'produtos' => $produtos,
                'semCategoria' => true,
            ]);
        }

        return view('produtos.index', [
            'produtos' => $produtos,
            'semCategoria' => false,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all();

        if ($categorias->isEmpty()) {
            return redirect()->route('categoria.cadastrar')
                ->with('warning', 'Cadastre uma categoria antes de criar um produto.');
        }

        return view('produtos.cadastrar', [
            'categorias' => $categorias,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|max:150',
            'codigo_barras' => 'required|max:50',
            'fabricante' => 'required|max:100',
            'unidade_medida' => 'required|max:20',
            'imagem' => 'nullable|string|max:255',
            'categoria_id' => 'nullable|exists:categorias,id',
            'estoque_minimo' => 'nullable|integer|min:0',
        ]);

        if (empty($request->categoria_id)) {
            return redirect()->route('categoria.cadastrar')
                ->with('warning', 'Selecione ou cadastre uma categoria antes de salvar o produto.');
        }

        Produto::create([
            'nome' => $request->nome,
            'codigo_barras' => $request->codigo_barras,
            'fabricante' => $request->fabricante,
            'unidade_medida' => $request->unidade_medida,
            'imagem' => $request->imagem,
            'categoria_id' => $request->categoria_id,
            'estoque_minimo' => $request->estoque_minimo ?? 0,
        ]);

        return redirect()->route('produto.index')
            ->with('success', 'Produto cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $produto = Produto::findOrFail($id);
        $categorias = Categoria::all();

        if ($categorias->isEmpty()) {
            return redirect()->route('categoria.cadastrar')
                ->with('warning', 'Cadastre uma categoria antes de editar este produto.');
        }

        return view('produtos.editar', [
            'produto' => $produto,
            'categorias' => $categorias,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nome' => 'required|max:150',
            'codigo_barras' => 'required|max:50',
            'fabricante' => 'required|max:100',
            'unidade_medida' => 'required|max:20',
            'imagem' => 'nullable|string|max:255',
            'categoria_id' => 'nullable|exists:categorias,id',
            'estoque_minimo' => 'nullable|integer|min:0',
        ]);

        if (empty($request->categoria_id)) {
            return redirect()->route('produto.index')
                ->with('warning', 'Selecione uma categoria antes de atualizar o produto.');
        }

        $produto = Produto::findOrFail($id);

        $produto->update([
            'nome' => $request->nome,
            'codigo_barras' => $request->codigo_barras,
            'fabricante' => $request->fabricante,
            'unidade_medida' => $request->unidade_medida,
            'imagem' => $request->imagem,
            'categoria_id' => $request->categoria_id,
            'estoque_minimo' => $request->estoque_minimo ?? 0,
        ]);

        return redirect()->route('produto.index')
            ->with('success', 'Produto atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $produto = Produto::findOrFail($id);
        $produto->delete();

        return redirect()->route('produto.index')
            ->with('success', 'Produto excluído com sucesso!');
    }
}

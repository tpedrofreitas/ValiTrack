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
         $produtos = Produto::all();

        return view('produtos.index', [
        'produtos'=>$produtos
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
          $categorias = Categoria::all();

         return view('produtos.cadastrar', [
        'categorias' => $categorias
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
        'categoria_id' => 'required|exists:categorias,id',
    ]);

    Produto::create([
        'nome' => $request->nome,
        'codigo_barras' => $request->codigo_barras,
        'fabricante' => $request->fabricante,
        'unidade_medida' => $request->unidade_medida,
        'categoria_id' => $request->categoria_id,
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

    return view('produtos.editar', [
        'produto' => $produto,
        'categorias' => $categorias
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
        'categoria_id' => 'required|exists:categorias,id',
    ]);

    $produto = Produto::findOrFail($id);

    $produto->update([
        'nome' => $request->nome,
        'codigo_barras' => $request->codigo_barras,
        'fabricante' => $request->fabricante,
        'unidade_medida' => $request->unidade_medida,
        'categoria_id' => $request->categoria_id,
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

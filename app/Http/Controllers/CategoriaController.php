<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    // Lista todas as categorias
    public function index()
    {
        $categorias = Categoria::all();

        return view('categorias.index', compact('categorias'));
    }

    // Abre a tela de cadastro
    public function create()
    {
        return view('categorias.cadastrar');
    }

    // Salva uma categoria
    public function store(Request $request)
    {
        $request->validate([
        'nome' => 'required|max:100',
        'descricao' => 'required|max:255'
    ]);

    Categoria::create([
        'nome' => $request->nome,
        'descricao' => $request->descricao
    ]);

    return redirect()
            ->route('categoria.index')
            ->with('success', 'Categoria cadastrada com sucesso!');
    }

    // Abre a tela de edição
    public function edit($id)
    {
        //
    }

    // Atualiza uma categoria
    public function update(Request $request, $id)
    {
        //
    }

    // Exclui uma categoria
    public function destroy($id)
    {
        //
    }
}

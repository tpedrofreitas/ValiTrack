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

        return view('categorias.index', [
        'categorias'=>$categorias
        ]);
    }

    // Abre a tela de cadastro
    public function create()
    {
        return view('categorias.cadastrar',[
        'categoria' => new Categoria()
        ]);
             
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
        return view('categorias.editar',[
        'categoria' => Categoria::findOrFail($id)
        ]);
    }

    // Atualiza uma categoria
    public function update(Request $request, $id)
    {
        $request->validate([
             'nome' => 'required|max:100',
            'descricao' => 'required|max:255'
        ]);

    $categoria = Categoria::findOrFail($id);

    $categoria->nome = $request->nome;
    $categoria->descricao = $request->descricao;

    $categoria->save();

    return redirect()
            ->route('categoria.index')
            ->with('success', 'Categoria cadastrada com sucesso!');
    }
    

    // Exclui uma categoria
    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);

        if ($categoria->produtos()->exists()) {
            return redirect()->route('categoria.index')
                ->with('error', 'Não é possível excluir esta categoria porque existem produtos relacionados a ela.');
        }

        $categoria->delete();

        return redirect()->route('categoria.index')
            ->with('success', 'Categoria excluída com sucesso!');
    }
}

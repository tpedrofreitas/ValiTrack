<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Fornecedor;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function index()
    {
        $fornecedores = Fornecedor::all();

        return view('fornecedores.index', [
            'fornecedores' => $fornecedores,
        ]);
    }

    public function create()
    {
        return view('fornecedores.cadastrar', [
            'fornecedor' => new Fornecedor(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|max:150',
            'contato' => 'required|max:100',
            'telefone' => 'required|max:20',
            'email' => 'required|email|max:150|unique:fornecedores,email',
            'cnpj' => 'required|max:18|unique:fornecedores,cnpj',
            'endereco' => 'required|max:255',
        ]);

        Fornecedor::create([
            'nome' => $request->nome,
            'contato' => $request->contato,
            'telefone' => $request->telefone,
            'email' => $request->email,
            'cnpj' => $request->cnpj,
            'endereco' => $request->endereco,
        ]);

        return redirect()->route('fornecedor.index')
            ->with('success', 'Fornecedor cadastrado com sucesso!');
    }

    public function edit($id)
    {
        return view('fornecedores.editar', [
            'fornecedor' => Fornecedor::findOrFail($id),
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|max:150',
            'contato' => 'required|max:100',
            'telefone' => 'required|max:20',
            'email' => 'required|email|max:150|unique:fornecedores,email,' . $id,
            'cnpj' => 'required|max:18|unique:fornecedores,cnpj,' . $id,
            'endereco' => 'required|max:255',
        ]);

        $fornecedor = Fornecedor::findOrFail($id);

        $fornecedor->update([
            'nome' => $request->nome,
            'contato' => $request->contato,
            'telefone' => $request->telefone,
            'email' => $request->email,
            'cnpj' => $request->cnpj,
            'endereco' => $request->endereco,
        ]);

        return redirect()->route('fornecedor.index')
            ->with('success', 'Fornecedor atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $fornecedor = Fornecedor::findOrFail($id);
        $fornecedor->delete();

        return redirect()->route('fornecedor.index')
            ->with('success', 'Fornecedor excluído com sucesso!');
    }
}

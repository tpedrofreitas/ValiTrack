<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Fornecedor;
use App\Http\Requests\Api\FornecedorRequest;

class FornecedorController extends Controller
{
    public function index()
    {
        return response()->json(Fornecedor::all());
    }

    public function show($id)
    {
        return response()->json(Fornecedor::findOrFail($id));
    }

    public function store(FornecedorRequest $request)
    {
        $data = $request->validated();

        $fornecedor = Fornecedor::create($data);

        return response()->json($fornecedor, 201);
    }

    public function update(FornecedorRequest $request, $id)
    {
        $data = $request->validated();

        $fornecedor = Fornecedor::findOrFail($id);

        $fornecedor->update($data);

        return response()->json($fornecedor);
    }

    public function destroy($id)
    {
        $fornecedor = Fornecedor::findOrFail($id);
        $fornecedor->delete();

        return response()->json(null, 204);
    }
}

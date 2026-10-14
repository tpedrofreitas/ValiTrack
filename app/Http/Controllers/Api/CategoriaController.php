<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Http\Requests\Api\CategoriaRequest;

class CategoriaController extends Controller
{
    public function index()
    {
        return response()->json(Categoria::all());
    }

    public function show($id)
    {
        return response()->json(Categoria::findOrFail($id));
    }

    public function store(CategoriaRequest $request)
    {
        $data = $request->validated();

        $categoria = Categoria::create($data);

        return response()->json($categoria, 201);
    }

    public function update(CategoriaRequest $request, $id)
    {
        $data = $request->validated();

        $categoria = Categoria::findOrFail($id);
        $categoria->update($data);

        return response()->json($categoria);
    }

    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);

        if ($categoria->produtos()->exists()) {
            return response()->json([
                'message' => 'Não é possível excluir esta categoria porque existem produtos relacionados a ela.'
            ], 409);
        }

        $categoria->delete();

        return response()->json(null, 204);
    }
}

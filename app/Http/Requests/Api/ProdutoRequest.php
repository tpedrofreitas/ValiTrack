<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'nome' => 'required|max:150',
            'codigo_barras' => 'required|max:50',
            'fabricante' => 'required|max:100',
            'unidade_medida' => 'required|max:20',
            'imagem' => 'nullable|string|max:255',
            'categoria_id' => 'required|exists:categorias,id',
            'estoque_minimo' => 'nullable|integer|min:0',
        ];

        return $rules;
    }
}

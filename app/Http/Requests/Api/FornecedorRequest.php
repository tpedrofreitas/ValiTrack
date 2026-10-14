<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class FornecedorRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = $this->route('id');

        return [
            'nome' => 'required|max:150',
            'contato' => 'required|max:100',
            'telefone' => 'required|max:20',
            'email' => 'required|email|max:150|unique:fornecedores,email' . ($id ? (',' . $id) : ''),
            'cnpj' => 'required|max:18|unique:fornecedores,cnpj' . ($id ? (',' . $id) : ''),
            'endereco' => 'required|max:255',
        ];
    }
}

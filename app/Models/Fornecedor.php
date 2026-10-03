<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    use HasFactory;

    protected $table = 'fornecedores';

    protected $fillable = [
        'nome',
        'contato',
        'telefone',
        'email',
        'cnpj',
        'endereco',
    ];

    public function lotes()
    {
        return $this->hasMany(Lote::class);
    }
}

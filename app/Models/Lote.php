<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lote extends Model
{
    use HasFactory;
    protected $table = 'lote';

    protected $fillable = [
        'numero_lote',
        'quantidade',
        'data_fabricação',
        'data_validade',
        'data_entrada',
        'status',
        'produto_id',

    ];
}

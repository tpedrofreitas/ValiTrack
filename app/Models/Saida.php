<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saida extends Model
{
    use HasFactory;

    protected $table = 'saidas';

    protected $fillable = [
        'produto_id',
        'lote_id',
        'quantidade',
        'data_saida',
        'motivo',
        'observacao',
    ];

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }

    public function lote()
    {
        return $this->belongsTo(Lote::class);
    }
}

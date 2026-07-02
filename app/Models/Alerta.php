<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alerta extends Model
{
    use HasFactory;
      protected $table = 'alerta';

    protected $fillable = [
       'tipo_alerta',
       'data_alerta',
       'visualizado',
       'lote_id',
    ];

    /**
     * Relacionamento com Categoria
     */
    public function lote()
    {
        return $this->belongsTo(Lote::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    protected $fillable = [
        "quantidade",
        "valor",
        "data",
        "cliente_id",
        "produto_id",
        "valor_unit"
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

   public function parcelas()
{
    return $this->hasMany(Parcela::class, 'venda_id');
}

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Intens_venda extends Model
{
    protected $fillable = [
        'vendas_id',
        'produtos_id',
        'quantidade',
        'valor',
        'valor_unit'
    ];
        public function venda(){
        return $this->hasMany(Venda::class, 'vendas_id');
    }

        public function produto(){
        return $this->hasMany(Produtos::class, 'produtos_id');
    }
}

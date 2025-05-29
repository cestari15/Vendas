<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        "nome",
        "cpf",
        "password"
    ];

        public function venda(){
        return $this->hasMany(Venda::class, 'vendas_id');
    }
}

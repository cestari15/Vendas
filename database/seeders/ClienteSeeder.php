<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $cliente = [
            [
                "id" => 1,
                "nome"=>"Cliente01",
                "cpf"=>12345678910,
                "password"=>"1234567"
            ],

        ];

        DB::table('clientes')->insert($cliente);
    }
}

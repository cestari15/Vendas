<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdutosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $produto = [
            [
                "id" => 1,
                "nome" => "Mouse",
                "valor_unit"=>50.00
            ],

        ];

        DB::table('produtos')->insert($produto);
    }
}

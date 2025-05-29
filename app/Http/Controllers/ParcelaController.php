<?php

namespace App\Http\Controllers;

use App\Models\Parcela;
use Illuminate\Http\Request;

class ParcelaController extends Controller
{
    public function parcelas(Request $request)
    {
        $parcelas = $request->parcelas;
        $total_venda = $request->total_venda;

        $somaValores = 0;
        $semValor = [];

        for ($i = 0; $i < count($parcelas); $i++) {
            if (isset($parcelas[$i]['valor']) && $parcelas[$i]['valor'] > 0) {
                $somaValores += $parcelas[$i]['valor'];
            } else {
                $semValor[] = $i;
            }
        }

        if ($somaValores > $total_venda) {
            return response()->json([
                'status' => false,
                'message' => "Valor das parcelas ultrapassa o valor da venda"
            ]);
        }

        $valor_res = $total_venda - $somaValores;

        if (count($semValor) > 0) {
            $valorParcela = $valor_res / count($semValor);
        } else {
            $valorParcela = 0;
        }

        $ajuste = $valor_res - ($valorParcela * count($semValor));

        
        $ultimoIndice = -1;
        if (count($semValor) > 0) {
            $ultimoIndice = $semValor[count($semValor) - 1];
        }


        for ($i = 0; $i < count($parcelas); $i++) {
            if (isset($parcelas[$i]['valor']) && $parcelas[$i]['valor'] > 0) {
                $valor = $parcelas[$i]['valor'];
            } else {
                $valor = $valorParcela;

                if ($i == $ultimoIndice) {
                    $valor = $valor + $ajuste;
                }
            }

            Parcela::create([
                'vendas_id' => $request->vendas_id,
                'valor' => $valor,
                'data_vencimento' => $parcelas[$i]['data_vencimento'],
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => "Parcelas criadas com sucesso"
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\VendaFormRequest;
use App\Http\Requests\VendaFormRequestUpdate;
use App\Models\Venda;
use Illuminate\Http\Request;

class VendaController extends Controller
{


    public function store(VendaFormRequest $request)
    {
        $validated = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'produto_id' => 'required|exists:produtos,id',
            'data' => 'required|date',
            'valor' => 'required|numeric',
            'quantidade' => 'required|integer|min:1',
            'tipo_pagamento' => 'required|string',
            'parcelas' => 'required|array|min:1',
            'parcelas.*.valor' => 'required|numeric',
            'parcelas.*.data' => 'required|date',
        ]);
        $valorUnit = $validated['valor'] / $validated['quantidade'];

        $venda = Venda::create([
            'cliente_id' => $validated['cliente_id'],
            'produto_id' => $validated['produto_id'],
            'data' => $validated['data'],
            'valor' => $validated['valor'],
            'quantidade' => $validated['quantidade'],
            'tipo_pagamento' => $validated['tipo_pagamento'],
            'valor_unit' => $valorUnit,
        ]);


        foreach ($validated['parcelas'] as $parcela) {
            $venda->parcelas()->create([
                'valor' => $parcela['valor'],
                'data_vencimento' => $parcela['data'],
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Venda cadastrada com sucesso']);
    }


    public function delete($id)
    {
        $venda = Venda::find($id);

        if (!isset($venda)) {
            return response()->json([
                'status' => false,
                'message' => "Venda não Encontrada"
            ]);
        }

        $venda->delete();
        return response()->json([
            'status' => true,
            'message' => "Venda excluida com sucesso"
        ]);
    }

    public function editar(VendaFormRequestUpdate $request)
{
    $venda = Venda::find($request->id);

    if (!isset($venda)) {
        return response()->json([
            'status' => false,
            'message' => "Venda não encontrada"
        ]);
    }

    
    $totalParcelas = 0;
    if ($request->has('parcelas')) {
        foreach ($request->parcelas as $parcela) {
            $totalParcelas += $parcela['valor'];
        }

       
        if ($totalParcelas > $request->valor) {
            return response()->json([
                'status' => false,
                'message' => 'A soma das parcelas excede o valor total da venda.'
            ]);
        }
    }


    if (isset($request->quantidade)) {
        $venda->quantidade = $request->quantidade;
    }

    if (isset($request->valor_unit)) {
        $venda->valor_unit = $request->valor_unit;
    }

    if (isset($request->cliente_id)) {
        $venda->cliente_id = $request->cliente_id;
    }

    if (isset($request->produto_id)) {
        $venda->produto_id = $request->produto_id;
    }

    if (isset($request->data)) {
        $venda->data = $request->data;
    }

    if (isset($request->tipo_pagamento)) {
        $venda->tipo_pagamento = $request->tipo_pagamento;
    }

    if (isset($request->valor)) {
        $venda->valor = $request->valor;
    }

    $venda->save();

 
    if ($request->has('parcelas')) {
        $venda->parcelas()->delete();

        foreach ($request->parcelas as $parcela) {
            $venda->parcelas()->create([
                'valor' => $parcela['valor'],
                'data_vencimento' => $parcela['data_vencimento']
            ]);
        }
    }

    return response()->json([
        'status' => true,
        'message' => 'Venda atualizada com sucesso.'
    ]);
}


    public function retornarTodos()
    {
        $venda = Venda::with('parcelas')->get();

        if ($venda->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'Nenhuma venda realizada'
            ]);
        }

        return response()->json([
            'status' => true,
            'data' => $venda
        ]);
    }

    public function pesquisarPorId($id)
    {
        $venda = Venda::with('parcelas')->find($id);

        if (!$venda) {
            return response()->json([
                'status' => false,
                'message' => "Venda não encontrada"
            ]);
        }

        return response()->json([
            'status' => true,
            'data' => $venda
        ]);
    }

    public function pesquisar(Request $request)
    {

        $query = Venda::query();

        $query->where(function ($q) use ($request) {
            $q->where('cliente_id', 'like', '%' . $request->input('pesquisa') . '%')
                ->orWhere('produto_id', 'like', '%' . $request->input('pesquisa') . '%')
                ->where('data', 'like', '%' . $request->input('pesquisa') . '%');
        });

        $venda = $query->get();
        if (count($venda) > 0) {
            return response()->json([
                'status' => true,
                'data' => $venda
            ]);
        }
        return response()->json([
            'status' => false,
            'data' => "Nenhum resultado encontrado"
        ]);
    }
}

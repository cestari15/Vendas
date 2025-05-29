<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdutosFormRequest;
use App\Models\Produtos;
use Illuminate\Http\Request;

class ProdutosController extends Controller
{
    public function store(ProdutosFormRequest $request)
    {
        $produtos = Produtos::create([
            'nome' => $request->nome,
            'valor_unit' => $request->valor_unit
        ]);

        return response()->json([
            "success" => true,
            "message" => "Produto cadastrado com sucesso",
            "data" => $produtos
        ], 200);
    }



    public function delete($id)
    {
        $produtos = Produtos::find($id);

        if (!isset($produtos)) {
            return response()->json([
                'status' => false,
                'message' => "Produto não Sencontrado"
            ]);
        }

        $produtos->delete();
        return response()->json([
            'status' => true,
            'message' => "Produto excluido com sucesso"
        ]);
    }


    public function editar(ProdutosFormRequest $request)

    {

        $produtos = Produtos::find($request->id);

        if (!isset($produtos)) {
            return response()->json([
                'status' => false,
                'message' => "Produto não Sencontrado"
            ]);
        }

        if (isset($request->nome)) {
            $produtos->nome = $request->nome;
        }


        if (isset($request->valor_unit)) {
            $produtos->valor_unit = $request->valor_unit;
        }

        $produtos->update();

        return response()->json([
            'status' => true,
            'message' => 'Produto atualizado.'
        ]);
    }


    public function retornarTodos()
    {
        $produtos = Produtos::all();
        if ($produtos == null) {
            return response()->json([
                'status' => false,
                'message' => 'não foi encontrado'
            ]);
        }
        return response()->json([
            'status' => true,
            'data' => $produtos
        ]);
    }


    public function pesquisarPorId($id)
    {
        $produtos = Produtos::find($id);
        if ($produtos == null) {
            return response()->json([
                'status' => false,
                'message' => "Produto não encontrado"
            ]);
        }
        return response()->json([
            'status' => true,
            'data' => $produtos
        ]);
    }

    public function pesquisar(Request $request)
    {

        $query = Produtos::query();

        $query->where(function ($q) use ($request) {
            $q->where('nome', 'like', '%' . $request->input('pesquisa') . '%');
             
        });

        $produtos = $query->get();
        if (count($produtos) > 0) {
            return response()->json([
                'status' => true,
                'data' => $produtos
            ]);
        }
        return response()->json([
            'status' => false,
            'data' => "Nenhum resultado encontrado"
        ]);
    }
}

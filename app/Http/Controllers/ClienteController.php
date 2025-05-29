<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteFormRequest;
use App\Http\Requests\ClienteFormRequestUpdate;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClienteController extends Controller
{
    public function store(ClienteFormRequest $request)
    {
        $clientes = Cliente::create([
            'nome' => $request->nome,
            'cpf' => $request->cpf,
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            "status" => true,
            "message" => "Cliente cadastrado com sucesso",
            "data" => $clientes
        ], 200);
    }

    public function delete($id)
    {
        $clientes = Cliente::find($id);

        if (!isset($clientes)) {
            return response()->json([
                'status' => false,
                'message' => "Cliente não Sencontrado"
            ]);
        }

        $clientes->delete();
        return response()->json([
            'status' => true,
            'message' => "Cliente excluido com sucesso"
        ]);
    }




    public function editar(ClienteFormRequestUpdate $request)
    {

        $clientes = Cliente::find($request->id);

        if (!isset($clientes)) {
            return response()->json([
                'status' => false,
                'message' => "Cliente não Sencontrado"
            ]);
        }

        if (isset($request->nome)) {
            $clientes->nome = $request->nome;
        }


        if (isset($request->cpf)) {
            $clientes->cpf = $request->cpf;
        }

 
        if (isset($request->password)) {
            $clientes->password = $request->password;
        }

        $clientes->update();

        return response()->json([
            'status' => true,
            'message' => 'Cliente atualizado.'
        ]);
    }


       public function retornarTodos(){
        $clientes = Cliente::all();

        if($clientes == null){
            return response()->json([
                'status'=>false,
                'message'=>'Nenhum cliente cadastrado'
            ]);
        }
        return response()->json([
            'status'=>true,
            'data'=>$clientes
        ]);
    }


    public function pesquisar(Request $request)
    {

        $query = Cliente::query();

        $query->where(function ($q) use ($request) {
            $q->where('nome', 'like', '%' . $request->input('pesquisa') . '%')
                ->orWhere('cpf', 'like', '%' . $request->input('pesquisa') . '%');
             
        });

        $clientes = $query->get();
        if (count($clientes) > 0) {
            return response()->json([
                'status' => true,
                'data' => $clientes
            ]);
        }
        return response()->json([
            'status' => false,
            'data' => "Nenhum resultado encontrado"
        ]);
    }

     public function pesquisarPorId($id){
        $clientes = Cliente::find($id);
        if($clientes == null){
            return response()->json([
                'status'=>false,
                'message'=> "cliente não encontrado"
            ]);
        }
        return response()->json([
            'status'=>true,
            'data'=> $clientes
        ]);

        }
}

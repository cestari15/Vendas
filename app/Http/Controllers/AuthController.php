<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'cpf' => 'required|string',
            'password' => 'required|string',
        ]);

        $cliente = Cliente::where('cpf', $request->cpf)->first();

        if (!$cliente || !Hash::check($request->password, $cliente->password)) {
            return response()->json([
                'status' => false,
                'message' => 'CPF ou senha incorretos',
            ], 401);
        }

        return response()->json([
            'status' => true,
            'message' => 'Login realizado com sucesso',
            'cliente' => $cliente,
        ]);
    }
}

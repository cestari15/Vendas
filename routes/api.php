<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\VendaController;
use App\Http\Controllers\ParcelaController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// ROTAS CLIENTES
Route::post('cliente/store', [ClienteController::class, 'store']);
Route::delete('cliente/delete/{id}', [ClienteController::class, 'delete']);
Route::put('cliente/update', [ClienteController::class, 'editar']);
Route::get('cliente/all', [ClienteController::class, 'retornarTodos']);
Route::post('cliente/pesquisar', [ClienteController::class, 'pesquisar']);
Route::get('cliente/pesquisa/{id}', [ClienteController::class, 'pesquisarPorId']);

// ROTAS PRODUTOS
Route::post('produto/store', [ProdutosController::class, 'store']);
Route::delete('produto/delete/{id}', [ProdutosController::class, 'delete']);
Route::put('produto/update', [ProdutosController::class, 'editar']);
Route::get('produto/all', [ProdutosController::class, 'retornarTodos']);
Route::get('produto/pesquisa/{id}', [ProdutosController::class, 'pesquisarPorId']);
Route::post('produto/pesquisar', [ProdutosController::class, 'pesquisar']);
// ROTAS VENDAS
Route::post('venda/store', [VendaController::class, 'store']);
Route::delete('venda/delete/{id}', [VendaController::class, 'delete']);
Route::put('venda/update', [VendaController::class, 'editar']);
Route::get('venda/all', [VendaController::class, 'retornarTodos']);
Route::get('venda/pesquisar/{id}', [VendaController::class, 'pesquisarPorId']);
Route::post('venda/pesquisar', [VendaController::class, 'pesquisar']);

// ROTAS PARCELA
Route::post('parcela/store', [ParcelaController::class, 'parcelas']);
//LOGIN
Route::post('login', [AuthController::class, 'login']);

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoriaController as CategoriaApiController;
use App\Http\Controllers\Api\ProdutoController as ProdutoApiController;
use App\Http\Controllers\Api\FornecedorController as FornecedorApiController;
use App\Http\Controllers\Api\EstoqueController as EstoqueApiController;
use App\Http\Controllers\Api\LoteController as LoteApiController;
use App\Http\Controllers\Api\SaidaController as SaidaApiController;

Route::prefix('v1')->middleware('api')->group(function () {
    Route::get('categorias', [CategoriaApiController::class, 'index']);
    Route::get('categorias/{id}', [CategoriaApiController::class, 'show']);
    Route::post('categorias', [CategoriaApiController::class, 'store']);
    Route::put('categorias/{id}', [CategoriaApiController::class, 'update']);
    Route::delete('categorias/{id}', [CategoriaApiController::class, 'destroy']);

    Route::get('produtos', [ProdutoApiController::class, 'index']);
    Route::get('produtos/{id}', [ProdutoApiController::class, 'show']);
    Route::post('produtos', [ProdutoApiController::class, 'store']);
    Route::put('produtos/{id}', [ProdutoApiController::class, 'update']);
    Route::delete('produtos/{id}', [ProdutoApiController::class, 'destroy']);

    // Lotes (entrada de estoque com validade)
    Route::post('produtos/{id}/lotes', [LoteApiController::class, 'store']);

    // Saídas de estoque
    Route::post('produtos/{id}/saidas', [SaidaApiController::class, 'store']);

    Route::get('fornecedores', [FornecedorApiController::class, 'index']);
    Route::get('fornecedores/{id}', [FornecedorApiController::class, 'show']);
    Route::post('fornecedores', [FornecedorApiController::class, 'store']);
    Route::put('fornecedores/{id}', [FornecedorApiController::class, 'update']);
    Route::delete('fornecedores/{id}', [FornecedorApiController::class, 'destroy']);

    // Estoque
    Route::get('estoque', [EstoqueApiController::class, 'index']);
    Route::get('estoque/{id}', [EstoqueApiController::class, 'show']);
});

// Backwards compatibility: register non-versioned routes (/api/...) too
Route::middleware('api')->group(function () {
    Route::get('categorias', [CategoriaApiController::class, 'index']);
    Route::get('categorias/{id}', [CategoriaApiController::class, 'show']);
    Route::post('categorias', [CategoriaApiController::class, 'store']);
    Route::put('categorias/{id}', [CategoriaApiController::class, 'update']);
    Route::delete('categorias/{id}', [CategoriaApiController::class, 'destroy']);

    Route::get('produtos', [ProdutoApiController::class, 'index']);
    Route::get('produtos/{id}', [ProdutoApiController::class, 'show']);
    Route::post('produtos', [ProdutoApiController::class, 'store']);
    Route::put('produtos/{id}', [ProdutoApiController::class, 'update']);
    Route::delete('produtos/{id}', [ProdutoApiController::class, 'destroy']);

    // Lotes (sem versão)
    Route::post('produtos/{id}/lotes', [LoteApiController::class, 'store']);

    // Saídas (sem versão)
    Route::post('produtos/{id}/saidas', [SaidaApiController::class, 'store']);

    Route::get('fornecedores', [FornecedorApiController::class, 'index']);
    Route::get('fornecedores/{id}', [FornecedorApiController::class, 'show']);
    Route::post('fornecedores', [FornecedorApiController::class, 'store']);
    Route::put('fornecedores/{id}', [FornecedorApiController::class, 'update']);
    Route::delete('fornecedores/{id}', [FornecedorApiController::class, 'destroy']);

    // Estoque (sem versão)
    Route::get('estoque', [EstoqueApiController::class, 'index']);
    Route::get('estoque/{id}', [EstoqueApiController::class, 'show']);
    //kkkkkkkkkkkk
});
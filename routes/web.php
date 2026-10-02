<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    // ==========================
    // CATEGORIAS
    // ==========================

    Route::get('/dashboard/categorias', [CategoriaController::class, 'index'])
        ->name('categoria.index');

    Route::get('/dashboard/categorias/cadastrar', [CategoriaController::class, 'create'])
        ->name('categoria.cadastrar');

    Route::post('/dashboard/categorias/salvar', [CategoriaController::class, 'store'])
        ->name('categoria.salvar');

    Route::get('/dashboard/categorias/editar/{id}', [CategoriaController::class, 'edit'])
        ->name('categoria.editar');

    Route::put('/dashboard/categorias/atualizar/{id}', [CategoriaController::class, 'update'])
        ->name('categoria.atualizar');

    Route::delete('/dashboard/categorias/excluir/{id}', [CategoriaController::class, 'destroy'])
        ->name('categoria.excluir');

    // ==========================
    // PRODUTOS
    // ==========================

    Route::get('/dashboard/produtos', [ProdutoController::class, 'index'])
        ->name('produto.index');

    Route::get('/dashboard/produtos/cadastrar', [ProdutoController::class, 'create'])
        ->name('produto.cadastrar');

    Route::post('/dashboard/produtos/salvar', [ProdutoController::class, 'store'])
        ->name('produto.salvar');

    Route::get('/dashboard/produtos/editar/{id}', [ProdutoController::class, 'edit'])
        ->name('produto.editar');

    Route::put('/dashboard/produtos/atualizar/{id}', [ProdutoController::class, 'update'])
        ->name('produto.atualizar');

    Route::delete('/dashboard/produtos/excluir/{id}', [ProdutoController::class, 'destroy'])
        ->name('produto.excluir');

    // ==========================
    // FORNECEDORES
    // ==========================

    Route::get('/dashboard/fornecedores', [FornecedorController::class, 'index'])
        ->name('fornecedor.index');

    Route::get('/dashboard/fornecedores/cadastrar', [FornecedorController::class, 'create'])
        ->name('fornecedor.cadastrar');

    Route::post('/dashboard/fornecedores/salvar', [FornecedorController::class, 'store'])
        ->name('fornecedor.salvar');

    Route::get('/dashboard/fornecedores/editar/{id}', [FornecedorController::class, 'edit'])
        ->name('fornecedor.editar');

    Route::put('/dashboard/fornecedores/atualizar/{id}', [FornecedorController::class, 'update'])
        ->name('fornecedor.atualizar');

    Route::delete('/dashboard/fornecedores/excluir/{id}', [FornecedorController::class, 'destroy'])
        ->name('fornecedor.excluir');

    // ==========================
    // PERFIL
    // ==========================

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
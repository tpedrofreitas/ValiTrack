<?php

use App\Http\Controllers\CategoriaController;
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
    Route::get('/cadastrar',[ProdutoController::class, 'create'])->name('produto.cadastrar');

    Route::get('/dashboard/categorias', [CategoriaController::class, 'index'])
    ->name('categoria.index');

    Route::get('/categorias/cadastrar', [CategoriaController::class, 'create'])
    ->name('categoria.cadastrar');

    Route::post('/categorias/salvar', [CategoriaController::class, 'store'])
    ->name('categoria.salvar');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

<?php

use App\Models\Categoria;
use App\Models\Produto;

it('cria produto com categoria e lista produtos', function () {
    $categoria = Categoria::create(['nome' => 'CatP', 'descricao' => 'd']);

    $payload = [
        'nome' => 'Prod1',
        'codigo_barras' => '123456',
        'fabricante' => 'Fabr',
        'unidade_medida' => 'un',
        'categoria_id' => $categoria->id,
    ];

    $this->postJson('/api/v1/produtos', $payload)
        ->assertStatus(201)
        ->assertJsonFragment(['nome' => 'Prod1']);

    $this->getJson('/api/v1/produtos')
        ->assertStatus(200)
        ->assertJsonFragment(['nome' => 'Prod1']);
});

it('atualiza e deleta produto', function () {
    $categoria = Categoria::create(['nome' => 'CatP2', 'descricao' => 'd2']);

    $produto = Produto::create([
        'nome' => 'Pold',
        'codigo_barras' => '999',
        'fabricante' => 'F',
        'unidade_medida' => 'un',
        'categoria_id' => $categoria->id,
    ]);

    $this->putJson("/api/v1/produtos/{$produto->id}", [
        'nome' => 'Pnew',
        'codigo_barras' => '999',
        'fabricante' => 'F',
        'unidade_medida' => 'un',
        'categoria_id' => $categoria->id,
    ])->assertStatus(200)->assertJsonFragment(['nome' => 'Pnew']);

    $this->deleteJson("/api/v1/produtos/{$produto->id}")->assertStatus(204);
});

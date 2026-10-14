<?php

use App\Models\Categoria;

it('cria e lista categorias', function () {
    $payload = ['nome' => 'Categoria Test', 'descricao' => 'Descrição teste'];

    $this->postJson('/api/v1/categorias', $payload)
        ->assertStatus(201)
        ->assertJsonFragment(['nome' => 'Categoria Test']);

    $this->getJson('/api/v1/categorias')
        ->assertStatus(200)
        ->assertJsonFragment(['nome' => 'Categoria Test']);
});

it('atualiza e deleta categoria', function () {
    $categoria = Categoria::create(['nome' => 'Antiga', 'descricao' => 'd']);

    $this->putJson("/api/v1/categorias/{$categoria->id}", ['nome' => 'Nova', 'descricao' => 'nova'])
        ->assertStatus(200)
        ->assertJsonFragment(['nome' => 'Nova']);

    $this->deleteJson("/api/v1/categorias/{$categoria->id}")
        ->assertStatus(204);
});

<?php

use App\Models\Fornecedor;

it('cria e lista fornecedor', function () {
    $payload = [
        'nome' => 'Forn Test',
        'contato' => 'Contato',
        'telefone' => '11111111',
        'email' => 'forn@test.local',
        'cnpj' => '12.345.678/0001-99',
        'endereco' => 'Rua X',
    ];

    $this->postJson('/api/v1/fornecedores', $payload)
        ->assertStatus(201)
        ->assertJsonFragment(['nome' => 'Forn Test']);

    $this->getJson('/api/v1/fornecedores')
        ->assertStatus(200)
        ->assertJsonFragment(['nome' => 'Forn Test']);
});

it('atualiza e deleta fornecedor', function () {
    $forn = Fornecedor::create([
        'nome' => 'FOld',
        'contato' => 'C',
        'telefone' => '2222',
        'email' => 'old@test.local',
        'cnpj' => '11.111.111/0001-11',
        'endereco' => 'Rua Y',
    ]);

    $this->putJson("/api/v1/fornecedores/{$forn->id}", [
        'nome' => 'FNew',
        'contato' => 'C',
        'telefone' => '2222',
        'email' => 'new@test.local',
        'cnpj' => '11.111.111/0001-11',
        'endereco' => 'Rua Y',
    ])->assertStatus(200)->assertJsonFragment(['nome' => 'FNew']);

    $this->deleteJson("/api/v1/fornecedores/{$forn->id}")->assertStatus(204);
});

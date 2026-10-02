<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fornecedores', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 150);
            $table->string('contato', 100);
            $table->string('telefone', 20);
            $table->string('email', 150)->unique();
            $table->string('cnpj', 18)->unique();
            $table->string('endereco', 255);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fornecedores');
    }
};

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('categorias')->insert([
            [
                'nome' => 'Alimentos',
                'descricao' => 'Produtos alimentícios',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nome' => 'Bebidas',
                'descricao' => 'Produtos líquidos',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nome' => 'Limpeza',
                'descricao' => 'Produtos de limpeza',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('produtos')->insert([
                [
                    'nome' => 'Arroz Tipo 1',
                    'codigo_barras' => '789100000001',
                    'fabricante' => 'Camil',
                    'unidade_medida' => 'kg',
                    'imagem' => 'produtos/laravel12.jpg',
                    'categoria_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'nome' => 'Feijão Carioca ',
                    'imagem' => 'produtos/laravel12.jpg',
                    'codigo_barras' => '789100000002',
                    'fabricante' => 'Kicaldo',
                    'unidade_medida' => 'kg',
                    'categoria_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'nome' => 'Macarrão Espaguete',
                    'imagem' => 'produtos/laravel12.jpg',
                    'codigo_barras' => '789100000003',
                    'fabricante' => 'Renata',
                    'unidade_medida' => 'g',
                    'categoria_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'nome' => 'Açúcar Refinado',
                    'imagem' => 'produtos/laravel12.jpg',
                    'codigo_barras' => '789100000004',
                    'fabricante' => 'União',
                    'unidade_medida' => 'kg',
                    'categoria_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'nome' => 'Café Torrado',
                    'imagem' => 'produtos/laravel12.jpg',
                    'codigo_barras' => '789100000005',
                    'fabricante' => 'Pilão',
                    'unidade_medida' => 'g',
                    'categoria_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'nome' => 'Refrigerante Cola',
                    'imagem' => 'produtos/laravel12.jpg',
                    'codigo_barras' => '789100000006',
                    'fabricante' => 'Coca-Cola',
                    'unidade_medida' => 'L',
                    'categoria_id' => 2,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'nome' => 'Suco de Laranja',
                    'imagem' => 'produtos/laravel12.jpg',
                    'codigo_barras' => '789100000007',
                    'fabricante' => 'Del Valle',
                    'unidade_medida' => 'L',
                    'categoria_id' => 2,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'nome' => 'Água Mineral',
                    'imagem' => 'produtos/laravel12.jpg',
                    'codigo_barras' => '789100000008',
                    'fabricante' => 'Crystal',
                    'unidade_medida' => 'L',
                    'categoria_id' => 2,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'nome' => 'Energético',
                    'imagem' => 'produtos/laravel12.jpg',
                    'codigo_barras' => '789100000009',
                    'fabricante' => 'Red Bull',
                    'unidade_medida' => 'ml',
                    'categoria_id' => 2,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'nome' => 'Detergente Neutro',
                    'imagem' => 'produtos/laravel12.jpg',
                    'codigo_barras' => '789100000010',
                    'fabricante' => 'Ypê',
                    'unidade_medida' => 'ml',
                    'categoria_id' => 3,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'nome' => 'Água Sanitária',
                    'imagem' => 'produtos/laravel12.jpg',
                    'codigo_barras' => '789100000011',
                    'fabricante' => 'Qboa',
                    'unidade_medida' => 'L',
                    'categoria_id' => 3,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'nome' => 'Sabão em Pó',
                    'imagem' => 'produtos/laravel12.jpg',
                    'codigo_barras' => '789100000012',
                    'fabricante' => 'OMO',
                    'unidade_medida' => 'kg',
                    'categoria_id' => 3,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'nome' => 'Desinfetante Lavanda',
                    'imagem' => 'produtos/laravel12.jpg',
                    'codigo_barras' => '789100000013',
                    'fabricante' => 'Veja',
                    'unidade_medida' => 'L',
                    'categoria_id' => 3,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'nome' => 'Papel Higiênico',
                    'imagem' => 'produtos/laravel12.jpg',
                    'codigo_barras' => '789100000014',
                    'fabricante' => 'Neve',
                    'unidade_medida' => 'un',
                    'categoria_id' => 3,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'nome' => 'Shampoo',
                    'imagem' => 'produtos/laravel12.jpg',
                    'codigo_barras' => '789100000015',
                    'fabricante' => 'Pantene',
                    'unidade_medida' => 'ml',
                    'categoria_id' => 3,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'nome' => 'Condicionador',
                    'imagem' => 'produtos/laravel12.jpg',
                    'codigo_barras' => '789100000016',
                    'fabricante' => 'Pantene',
                    'unidade_medida' => 'ml',
                    'categoria_id' => 3,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'nome' => 'Creme Dental',
                    'imagem' => 'produtos/laravel12.jpg',
                    'codigo_barras' => '789100000017',
                    'fabricante' => 'Colgate',
                    'unidade_medida' => 'g',
                    'categoria_id' => 3,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'nome' => 'Sabonete',
                    'imagem' => 'produtos/laravel12.jpg',
                    'codigo_barras' => '789100000018',
                    'fabricante' => 'Dove',
                    'unidade_medida' => 'un',
                    'categoria_id' => 3,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'nome' => 'Leite Integral',
                    'imagem' => 'produtos/laravel12.jpg',
                    'codigo_barras' => '789100000019',
                    'fabricante' => 'Italac',
                    'unidade_medida' => 'L',
                    'categoria_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'nome' => 'Óleo de Soja',
                    'imagem' => 'produtos/laravel12.jpg',
                    'codigo_barras' => '789100000020',
                    'fabricante' => 'Liza',
                    'unidade_medida' => 'ml',
                    'categoria_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            ]);
    }
}

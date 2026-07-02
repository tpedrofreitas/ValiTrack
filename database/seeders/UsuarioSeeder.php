<?php
 
namespace Database\Seeders;
 
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
 
class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('usuarios')->insert([
            [
              'name'  => 'Luis Gustavo',
              'email' => 'luisgustavomarilia52@gmail.com',
              'password' => Hash::make(12345678),
              
            ],
            [
              'name'  => 'Thiago Freitas',
              'email' => 'thifreitas26@gmail.com',
              'password' => Hash::make(12345678),
              
            ]
        ]);
    }
}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Controle de Estoque</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gradient-to-r from-blue-700 to-blue-900 min-h-screen flex items-center justify-center">

    <div class="bg-white shadow-2xl rounded-2xl p-10 max-w-4xl w-full mx-6">

        <div class="text-center">

            <img src="{{ asset('img/ChatGPT Image 6 de jul. de 2026, 20_01_09.png') }}"
                 alt="Logo"
                 class="h-32 mx-auto mb-6">

            <h1 class="text-5xl font-bold text-gray-800">
                Sistema de Controle de Estoque
            </h1>

            <p class="text-gray-600 mt-4 text-lg">
                Gerencie seus produtos, categorias, fornecedores,
                entradas e saídas de estoque de forma simples,
                rápida e organizada.
            </p>

        </div>

        <div class="grid md:grid-cols-3 gap-6 mt-10">

            <div class="bg-blue-100 rounded-xl p-6 text-center">
                <div class="text-5xl">📦</div>

                <h2 class="font-bold text-xl mt-3">
                    Produtos
                </h2>

                <p class="text-gray-600 mt-2">
                    Cadastro e gerenciamento completo de produtos.
                </p>
            </div>

            <div class="bg-green-100 rounded-xl p-6 text-center">
                <div class="text-5xl">📁</div>

                <h2 class="font-bold text-xl mt-3">
                    Categorias
                </h2>

                <p class="text-gray-600 mt-2">
                    Organize os produtos por categorias.
                </p>
            </div>

            <div class="bg-yellow-100 rounded-xl p-6 text-center">
                <div class="text-5xl">📊</div>

                <h2 class="font-bold text-xl mt-3">
                    Relatórios
                </h2>

                <p class="text-gray-600 mt-2">
                    Consulte informações do estoque rapidamente.
                </p>
            </div>

        </div>

        <div class="text-center mt-10">

            @auth

                <a href="{{ route('dashboard') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg text-lg font-semibold">

                    Entrar no Sistema

                </a>

            @else

                <a href="{{ route('login') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg text-lg font-semibold">

                    Fazer Login

                </a>

            @endauth

        </div>

    </div>

</body>

</html>
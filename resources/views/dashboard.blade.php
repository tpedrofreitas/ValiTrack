<x-app-layout>

  

    <div class="py-10">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-lg rounded-xl p-8">

                <h1 class="text-3xl font-bold text-center text-gray-800 mb-2">
                    Sistema de Controle de Estoque
                </h1>

                <p class="text-center text-gray-500 mb-8">
                    Bem-vindo, <strong>{{ Auth::user()->name }}</strong>.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                    <!-- Categorias -->
                    <a href="{{ route('categoria.index') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white rounded-xl p-6 text-center shadow-lg transition">

                        <div class="text-5xl mb-4">📁</div>

                        <h2 class="text-xl font-bold">
                            Categorias
                        </h2>

                    </a>

                    <!-- Produtos -->
                    <a href="{{ route('produto.index') }}"
                        class="bg-green-600 hover:bg-green-700 text-white rounded-xl p-6 text-center shadow-lg transition">

                        <div class="text-5xl mb-4">📦</div>

                        <h2 class="text-xl font-bold">
                            Produtos
                        </h2>

                    </a>

                    <!-- Fornecedores -->
                    <div class="bg-gray-200 rounded-xl p-6 text-center">

                        <div class="text-5xl mb-4">🚚</div>

                        <h2 class="text-xl font-bold">
                            Fornecedores
                        </h2>

                        <p class="text-sm mt-2">
                            Em desenvolvimento
                        </p>

                    </div>

                    <!-- Entradas -->
                    <div class="bg-gray-200 rounded-xl p-6 text-center">

                        <div class="text-5xl mb-4">📥</div>

                        <h2 class="text-xl font-bold">
                            Entradas
                        </h2>

                        <p class="text-sm mt-2">
                            Em desenvolvimento
                        </p>

                    </div>

                    <!-- Saídas -->
                    <div class="bg-gray-200 rounded-xl p-6 text-center">

                        <div class="text-5xl mb-4">📤</div>

                        <h2 class="text-xl font-bold">
                            Saídas
                        </h2>

                        <p class="text-sm mt-2">
                            Em desenvolvimento
                        </p>

                    </div>

                    <!-- Relatórios -->
                    <div class="bg-gray-200 rounded-xl p-6 text-center">

                        <div class="text-5xl mb-4">📊</div>

                        <h2 class="text-xl font-bold">
                            Relatórios
                        </h2>

                        <p class="text-sm mt-2">
                            Em desenvolvimento
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>

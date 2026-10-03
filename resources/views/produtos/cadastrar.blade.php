<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Cadastrar Produto
        </h2>
    </x-slot>

    <div class="py-6">

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg p-6">

                <form action="{{ route('produto.salvar') }}" method="POST">

                    @csrf

                    <div class="mb-4">
                        <label for="nome" class="block font-medium">
                            Nome
                        </label>

                        <input type="text"
                               name="nome"
                               id="nome"
                               class="w-full border rounded px-3 py-2"
                               value="{{ old('nome') }}">
                    </div>

                    <div class="mb-4">
                        <label for="codigo_barras" class="block font-medium">
                            Código de Barras
                        </label>

                        <input type="text"
                               name="codigo_barras"
                               id="codigo_barras"
                               class="w-full border rounded px-3 py-2"
                               value="{{ old('codigo_barras') }}">
                    </div>

                    <div class="mb-4">
                        <label for="fabricante" class="block font-medium">
                            Fabricante
                        </label>

                        <input type="text"
                               name="fabricante"
                               id="fabricante"
                               class="w-full border rounded px-3 py-2"
                               value="{{ old('fabricante') }}">
                    </div>

                    <div class="mb-4">
                        <label for="unidade_medida" class="block font-medium">
                            Unidade de Medida
                        </label>

                        <input type="text"
                               name="unidade_medida"
                               id="unidade_medida"
                               class="w-full border rounded px-3 py-2"
                               value="{{ old('unidade_medida') }}">
                    </div>

                    <div class="mb-4">
                        <label for="imagem" class="block font-medium">
                            Imagem
                        </label>

                        <input type="text"
                               name="imagem"
                               id="imagem"
                               class="w-full border rounded px-3 py-2"
                               value="{{ old('imagem') }}"
                               placeholder="Ex: produtos/laravel12.jpg">
                    </div>

                    <div class="mb-4">
                        <label for="categoria_id" class="block font-medium">
                            Categoria
                        </label>

                        <select name="categoria_id"
                                id="categoria_id"
                                class="w-full border rounded px-3 py-2">

                            <option value="">Selecione uma categoria</option>

                            @foreach($categorias as $categoria)

                                <option value="{{ $categoria->id }}">
                                    {{ $categoria->nome }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="mb-4">
                        <label for="estoque_minimo" class="block font-medium">
                            Estoque Mínimo
                        </label>

                        <input type="number"
                               name="estoque_minimo"
                               id="estoque_minimo"
                               class="w-full border rounded px-3 py-2"
                               value="{{ old('estoque_minimo', 0) }}"
                               min="0">
                    </div>

                    <div class="flex gap-2">

                        <button type="submit"
                                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">

                            Salvar Produto

                        </button>

                        <a href="{{ route('produto.index') }}"
                           class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">

                            Voltar

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>

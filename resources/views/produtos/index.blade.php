<x-app-layout>

    @if(session('success'))

        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">

            {{ session('success') }}

        </div>

    @endif

    @if(session('warning'))

        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-4">

            {{ session('warning') }}

        </div>

    @endif

    @if($semCategoria ?? false)
        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-4">
            Ainda não existe nenhuma categoria cadastrada. Crie uma categoria antes de cadastrar produtos.
        </div>

        <div class="mb-6">
            <a href="{{ route('categoria.cadastrar') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Cadastrar categoria
            </a>
        </div>
    @endif

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Produtos
        </h2>
    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg p-6">

                <div class="flex justify-between items-center mb-6">

                    <h1 class="text-2xl font-bold">
                        Lista de Produtos
                    </h1>

                    <a href="{{ route('produto.cadastrar') }}"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">

                        Novo Produto

                    </a>

                </div>

                <table class="min-w-full border">

                    <thead class="bg-gray-100">

                        <tr>
                            <th class="border p-2">ID</th>
                            <th class="border p-2">Nome</th>
                            <th class="border p-2">Código de Barras</th>
                            <th class="border p-2">Fabricante</th>
                            <th class="border p-2">Unidade</th>
                            <th class="border p-2">Categoria</th>
                            <th class="border p-2">Estoque Mínimo</th>
                            <th class="border p-2">Ações</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($produtos as $p)

                            @php
                                $abaixoMinimo = $p->abaixoDoMinimo();
                                $statusClasses = $abaixoMinimo
                                    ? 'bg-red-100 text-red-700 border-red-200'
                                    : 'bg-green-100 text-green-700 border-green-200';
                            @endphp

                            <tr class="{{ $abaixoMinimo ? 'bg-red-50' : '' }}">

                                <td class="border p-2">
                                    {{ $p->id }}
                                </td>

                                <td class="border p-2">
                                    <div class="flex items-center gap-2">
                                        <span>{{ $p->nome }}</span>
                                        @if($abaixoMinimo)
                                            <span class="px-2 py-1 rounded text-xs font-medium border {{ $statusClasses }}">
                                                Estoque baixo
                                            </span>
                                        @endif
                                    </div>
                                </td>

                                <td class="border p-2">
                                    {{ $p->codigo_barras }}
                                </td>

                                <td class="border p-2">
                                    {{ $p->fabricante }}
                                </td>

                                <td class="border p-2">
                                    {{ $p->unidade_medida }}
                                </td>

                                <td class="border p-2">
                                    {{ $p->categoria->nome ?? 'Sem categoria' }}
                                </td>

                                <td class="border p-2">
                                    <div class="flex flex-col gap-1">
                                        <span>{{ $p->estoque_minimo ?? 0 }}</span>
                                        <span class="text-xs text-gray-500">Atual: {{ $p->estoqueDisponivel() }}</span>
                                    </div>
                                </td>

                                <td class="border p-2">

                                    <div class="flex">

                                        <a href="{{ route('produto.editar', $p->id) }}"
                                            class="bg-gray-300 px-3 py-2 rounded">

                                            Editar

                                        </a>

                                        <form action="{{ route('produto.excluir', $p->id) }}"
                                            method="POST">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="bg-red-300 px-3 py-2 rounded ml-2"
                                                onclick="return confirm('Deseja realmente excluir o registro?')">

                                                Excluir

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="8" class="text-center p-4">

                                    Nenhum produto cadastrado.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</x-app-layout>
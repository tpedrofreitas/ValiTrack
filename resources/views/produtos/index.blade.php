<x-app-layout>

    @if(session('success'))

        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">

            {{ session('success') }}

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
                            <th class="border p-2">Ações</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($produtos as $p)

                            <tr>

                                <td class="border p-2">
                                    {{ $p->id }}
                                </td>

                                <td class="border p-2">
                                    {{ $p->nome }}
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
                                    {{ $p->categoria->nome }}
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

                                <td colspan="7" class="text-center p-4">

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
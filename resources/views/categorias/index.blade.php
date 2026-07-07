<x-app-layout>

    @if(session('success'))

    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">

        {{ session('success') }}

    </div>

@endif

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Categorias
        </h2>
    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg p-6">

                <div class="flex justify-between items-center mb-6">

                    <h1 class="text-2xl font-bold">
                        Lista de Categorias
                    </h1>

                    <a href="{{ route('categoria.cadastrar') }}"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">

                        Nova Categoria

                    </a>

                </div>

                <table class="min-w-full border">

                    <thead class="bg-gray-100">

                        <tr>
                            <th class="border p-2">ID</th>
                            <th class="border p-2">Nome</th>
                            <th class="border p-2">Descrição</th>
                            <th class="border p-2">Ações</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($categorias as $categoria)

                            <tr>

                                <td class="border p-2">
                                    {{ $categoria->id }}
                                </td>

                                <td class="border p-2">
                                    {{ $categoria->nome }}
                                </td>

                                <td class="border p-2">
                                    {{ $categoria->descricao }}
                                </td>

                                <td class="border p-2">

                                    Editar | Excluir

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="4" class="text-center p-4">

                                    Nenhuma categoria cadastrada.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</x-app-layout>
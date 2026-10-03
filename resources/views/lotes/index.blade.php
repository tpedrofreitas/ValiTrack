<x-app-layout>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Entradas / Lotes
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">

                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold">Lista de Entradas</h1>

                    <a href="{{ route('lote.cadastrar') }}"
                       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Nova Entrada
                    </a>
                </div>

                <table class="min-w-full border">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border p-2">ID</th>
                            <th class="border p-2">Produto</th>
                            <th class="border p-2">Fornecedor</th>
                            <th class="border p-2">Lote</th>
                            <th class="border p-2">Quantidade</th>
                            <th class="border p-2">Validade</th>
                            <th class="border p-2">Status</th>
                            <th class="border p-2">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($lotes as $lote)
                            <tr>
                                <td class="border p-2">{{ $lote->id }}</td>
                                <td class="border p-2">{{ $lote->produto->nome ?? '-' }}</td>
                                <td class="border p-2">{{ $lote->fornecedor->nome ?? '-' }}</td>
                                <td class="border p-2">{{ $lote->numero_lote }}</td>
                                <td class="border p-2">{{ $lote->quantidade }}</td>
                                <td class="border p-2">{{ $lote->data_validade }}</td>
                                <td class="border p-2">{{ $lote->status }}</td>
                                <td class="border p-2">
                                    <div class="flex gap-2">
                                        <a href="{{ route('lote.editar', $lote->id) }}"
                                           class="bg-gray-300 px-3 py-2 rounded">
                                            Editar
                                        </a>

                                        <form action="{{ route('lote.excluir', $lote->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="bg-red-300 px-3 py-2 rounded"
                                                    onclick="return confirm('Deseja realmente excluir esta entrada?')">
                                                Excluir
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center p-4">
                                    Nenhuma entrada cadastrada.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>

</x-app-layout>

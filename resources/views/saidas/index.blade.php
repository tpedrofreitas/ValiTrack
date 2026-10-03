<x-app-layout>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Saídas
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">

                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold">Histórico de Saídas</h1>

                    <a href="{{ route('saida.cadastrar') }}"
                       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Nova Saída
                    </a>
                </div>

                <table class="min-w-full border">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border p-2">ID</th>
                            <th class="border p-2">Produto</th>
                            <th class="border p-2">Lote</th>
                            <th class="border p-2">Quantidade</th>
                            <th class="border p-2">Data</th>
                            <th class="border p-2">Motivo</th>
                            <th class="border p-2">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($saidas as $saida)
                            <tr>
                                <td class="border p-2">{{ $saida->id }}</td>
                                <td class="border p-2">{{ $saida->produto->nome ?? '-' }}</td>
                                <td class="border p-2">{{ $saida->lote->numero_lote ?? '-' }}</td>
                                <td class="border p-2">{{ $saida->quantidade }}</td>
                                <td class="border p-2">{{ $saida->data_saida }}</td>
                                <td class="border p-2">{{ $saida->motivo ?? '-' }}</td>
                                <td class="border p-2">
                                    <div class="flex gap-2">
                                        <a href="{{ route('saida.editar', $saida->id) }}"
                                           class="bg-gray-300 px-3 py-2 rounded">
                                            Editar
                                        </a>

                                        <form action="{{ route('saida.excluir', $saida->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="bg-red-300 px-3 py-2 rounded"
                                                    onclick="return confirm('Deseja realmente excluir esta saída?')">
                                                Excluir
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center p-4">
                                    Nenhuma saída cadastrada.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>

</x-app-layout>

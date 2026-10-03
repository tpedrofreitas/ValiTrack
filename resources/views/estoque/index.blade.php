<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Estoque por Produto e Lote
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">

                <h1 class="text-2xl font-bold mb-6">Controle de Estoque</h1>

                @forelse($estoque as $item)
                    @php
                        $produto = $item['produto'];
                        $abaixoMinimo = $produto->abaixoDoMinimo();
                    @endphp
                    <div class="mb-8 border rounded-lg p-4 {{ $abaixoMinimo ? 'border-red-200 bg-red-50' : '' }}">
                        <div class="flex justify-between items-center mb-4 gap-4">
                            <div class="flex items-center gap-3">
                                <h2 class="text-xl font-semibold">{{ $produto->nome }}</h2>
                                @if($abaixoMinimo)
                                    <span class="bg-red-100 text-red-700 px-2 py-1 rounded-full text-xs font-medium">
                                        Abaixo do mínimo
                                    </span>
                                @else
                                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs font-medium">
                                        Dentro do mínimo
                                    </span>
                                @endif
                            </div>
                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-medium">
                                Total disponível: {{ $item['total_disponivel'] }}
                            </span>
                        </div>

                        <div class="mb-4 text-sm text-gray-600">
                            Estoque mínimo: {{ $produto->estoque_minimo ?? 0 }}
                        </div>

                        <table class="min-w-full border">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="border p-2">Lote</th>
                                    <th class="border p-2">Quantidade Total</th>
                                    <th class="border p-2">Saldo Disponível</th>
                                    <th class="border p-2">Validade</th>
                                    <th class="border p-2">Situação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($item['lotes'] as $lote)
                                    <tr>
                                        <td class="border p-2">{{ $lote['numero_lote'] }}</td>
                                        <td class="border p-2">{{ $lote['quantidade_total'] }}</td>
                                        <td class="border p-2">{{ $lote['saldo_disponivel'] }}</td>
                                        <td class="border p-2">{{ $lote['data_validade'] }}</td>
                                        <td class="border p-2">
                                            @if($lote['situacao'] == 'Vencido')
                                                <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-sm font-medium">Vencido</span>
                                            @elseif($lote['situacao'] == 'Próximo do vencimento')
                                                <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-sm font-medium">Próximo do vencimento</span>
                                            @else
                                                <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-sm font-medium">Válido</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center p-4">Nenhum lote para este produto.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                @empty
                    <p class="text-gray-600">Nenhum produto cadastrado.</p>
                @endforelse

            </div>
        </div>
    </div>

</x-app-layout>

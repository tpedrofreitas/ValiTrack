<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Relatórios
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">

                <h1 class="text-2xl font-bold mb-6">Relatório de Validade e Estoque</h1>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                    <div class="bg-blue-100 rounded-lg p-4">
                        <div class="text-sm text-blue-700">Produtos cadastrados</div>
                        <div class="text-2xl font-bold text-blue-900 mt-2">{{ \App\Models\Produto::count() }}</div>
                    </div>

                    <div class="bg-green-100 rounded-lg p-4">
                        <div class="text-sm text-green-700">Valor total em estoque</div>
                        <div class="text-2xl font-bold text-green-900 mt-2">R$ {{ number_format($valorTotalEstoque ?? 0, 2, ',', '.') }}</div>
                    </div>

                    <div class="bg-yellow-100 rounded-lg p-4">
                        <div class="text-sm text-yellow-700">Produtos abaixo do mínimo</div>
                        <div class="text-2xl font-bold text-yellow-900 mt-2">{{ \App\Models\Produto::all()->filter(fn($produto) => $produto->abaixoDoMinimo())->count() }}</div>
                    </div>
                </div>

                <div class="mb-10">
                    <h2 class="text-xl font-bold mb-4">Resumo financeiro por produto</h2>

                    <table class="min-w-full border">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border p-2">Produto</th>
                                <th class="border p-2">Estoque atual</th>
                                <th class="border p-2">Estoque mínimo</th>
                                <th class="border p-2">Valor em estoque</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($resumoFinanceiro as $resumo)
                                @php
                                    $produto = $resumo['produto'];
                                @endphp
                                <tr class="{{ $produto->abaixoDoMinimo() ? 'bg-red-50' : '' }}">
                                    <td class="border p-2">{{ $produto->nome }}</td>
                                    <td class="border p-2">{{ $resumo['estoque_atual'] }}</td>
                                    <td class="border p-2">{{ $produto->estoque_minimo ?? 0 }}</td>
                                    <td class="border p-2">R$ {{ number_format($resumo['valor_em_estoque'], 2, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center p-4">Nenhum produto cadastrado.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <form method="GET" class="grid grid-cols-1 md:grid-cols-6 gap-4 mb-6">
                    <div>
                        <label class="block text-sm font-medium mb-1">Produto</label>
                        <select name="produto_id" class="w-full border rounded px-3 py-2">
                            <option value="">Todos</option>
                            @foreach($produtos as $produto)
                                <option value="{{ $produto->id }}" {{ request('produto_id') == $produto->id ? 'selected' : '' }}>
                                    {{ $produto->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Categoria</label>
                        <select name="categoria_id" class="w-full border rounded px-3 py-2">
                            <option value="">Todas</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}" {{ request('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                    {{ $categoria->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Fornecedor</label>
                        <select name="fornecedor_id" class="w-full border rounded px-3 py-2">
                            <option value="">Todos</option>
                            @foreach($fornecedores as $fornecedor)
                                <option value="{{ $fornecedor->id }}" {{ request('fornecedor_id') == $fornecedor->id ? 'selected' : '' }}>
                                    {{ $fornecedor->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Lote</label>
                        <input type="text" name="lote" value="{{ request('lote') }}" class="w-full border rounded px-3 py-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Situação</label>
                        <select name="situacao" class="w-full border rounded px-3 py-2">
                            <option value="">Todas</option>
                            <option value="Válido" {{ request('situacao') == 'Válido' ? 'selected' : '' }}>Válido</option>
                            <option value="Próximo do vencimento" {{ request('situacao') == 'Próximo do vencimento' ? 'selected' : '' }}>Próximo do vencimento</option>
                            <option value="Vencido" {{ request('situacao') == 'Vencido' ? 'selected' : '' }}>Vencido</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Estoque</label>
                        <select name="estoque_status" class="w-full border rounded px-3 py-2">
                            <option value="">Todos</option>
                            <option value="baixo" {{ request('estoque_status') == 'baixo' ? 'selected' : '' }}>Abaixo do mínimo</option>
                            <option value="normal" {{ request('estoque_status') == 'normal' ? 'selected' : '' }}>Dentro do mínimo</option>
                        </select>
                    </div>

                    <div class="md:col-span-6 flex justify-end">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Filtrar
                        </button>
                    </div>
                </form>

                <table class="min-w-full border">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border p-2">Produto</th>
                            <th class="border p-2">Categoria</th>
                            <th class="border p-2">Fornecedor</th>
                            <th class="border p-2">Lote</th>
                            <th class="border p-2">Estoque atual</th>
                            <th class="border p-2">Estoque mínimo</th>
                            <th class="border p-2">Validade</th>
                            <th class="border p-2">Situação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($lotes as $lote)
                            @php
                                $produto = $lote->produto;
                                $abaixoMinimo = $produto && $produto->abaixoDoMinimo();
                            @endphp
                            <tr class="{{ $abaixoMinimo ? 'bg-red-50' : '' }}">
                                <td class="border p-2">
                                    <div class="flex items-center gap-2">
                                        <span>{{ $produto->nome ?? '-' }}</span>
                                        @if($abaixoMinimo)
                                            <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs font-medium">Baixo</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="border p-2">{{ $produto->categoria->nome ?? '-' }}</td>
                                <td class="border p-2">{{ $lote->fornecedor->nome ?? '-' }}</td>
                                <td class="border p-2">{{ $lote->numero_lote }}</td>
                                <td class="border p-2">{{ $produto ? $produto->estoqueDisponivel() : 0 }}</td>
                                <td class="border p-2">{{ $produto->estoque_minimo ?? 0 }}</td>
                                <td class="border p-2">{{ $lote->data_validade }}</td>
                                <td class="border p-2">
                                    @if($lote->situacaoValidade() == 'Vencido')
                                        <span class="bg-red-100 text-red-700 px-2 py-1 rounded">Vencido</span>
                                    @elseif($lote->situacaoValidade() == 'Próximo do vencimento')
                                        <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded">Próximo do vencimento</span>
                                    @else
                                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded">Válido</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center p-4">Nenhum lote encontrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>

</x-app-layout>

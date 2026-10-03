@php
    $produtos = \App\Models\Produto::count();
    $estoqueTotal = \App\Models\Lote::with('saidas')->get()->sum(function ($lote) {
        return max(0, (int) $lote->quantidade - (int) $lote->saidas()->sum('quantidade'));
    });
    $proximos = \App\Models\Lote::whereNotNull('data_validade')->get()->filter(function ($lote) {
        return $lote->situacaoValidade() === 'Próximo do vencimento';
    })->count();
    $vencidos = \App\Models\Lote::whereNotNull('data_validade')->get()->filter(function ($lote) {
        return $lote->situacaoValidade() === 'Vencido';
    })->count();
    $alertas = \App\Models\Lote::with('produto')->whereNotNull('data_validade')->get()->filter(function ($lote) {
        return in_array($lote->situacaoValidade(), ['Próximo do vencimento', 'Vencido']);
    })->sortBy('data_validade');
    $produtosAbaixoMinimo = \App\Models\Produto::all()->filter(function ($produto) {
        return $produto->abaixoDoMinimo();
    });
@endphp

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

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-blue-100 rounded-xl p-5">
                        <div class="text-sm text-blue-700">Total de produtos</div>
                        <div class="text-3xl font-bold text-blue-900 mt-2">{{ $produtos }}</div>
                    </div>

                    <div class="bg-green-100 rounded-xl p-5">
                        <div class="text-sm text-green-700">Total em estoque</div>
                        <div class="text-3xl font-bold text-green-900 mt-2">{{ $estoqueTotal }}</div>
                    </div>

                    <div class="bg-yellow-100 rounded-xl p-5">
                        <div class="text-sm text-yellow-700">Próximos do vencimento</div>
                        <div class="text-3xl font-bold text-yellow-900 mt-2">{{ $proximos }}</div>
                    </div>

                    <div class="bg-red-100 rounded-xl p-5">
                        <div class="text-sm text-red-700">Vencidos</div>
                        <div class="text-3xl font-bold text-red-900 mt-2">{{ $vencidos }}</div>
                    </div>
                </div>

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
                    <a href="{{ route('fornecedor.index') }}"
                        class="bg-yellow-500 hover:bg-yellow-600 text-white rounded-xl p-6 text-center shadow-lg transition">

                        <div class="text-5xl mb-4">🚚</div>

                        <h2 class="text-xl font-bold">
                            Fornecedores
                        </h2>

                    </a>

                    <!-- Entradas -->
                    <a href="{{ route('lote.index') }}"
                        class="bg-indigo-500 hover:bg-indigo-600 text-white rounded-xl p-6 text-center shadow-lg transition">

                        <div class="text-5xl mb-4">📥</div>

                        <h2 class="text-xl font-bold">
                            Entradas
                        </h2>

                    </a>

                    <!-- Saídas -->
                    <a href="{{ route('saida.index') }}"
                        class="bg-red-500 hover:bg-red-600 text-white rounded-xl p-6 text-center shadow-lg transition">

                        <div class="text-5xl mb-4">📤</div>

                        <h2 class="text-xl font-bold">
                            Saídas
                        </h2>

                    </a>

                    <!-- Relatórios -->
                    <a href="{{ route('relatorio.index') }}"
                        class="bg-gray-400 hover:bg-gray-500 text-white rounded-xl p-6 text-center shadow-lg transition">

                        <div class="text-5xl mb-4">📊</div>

                        <h2 class="text-xl font-bold">
                            Relatórios
                        </h2>

                    </a>

                    <!-- Estoque -->
                    <a href="{{ route('estoque.index') }}"
                        class="bg-teal-500 hover:bg-teal-600 text-white rounded-xl p-6 text-center shadow-lg transition">

                        <div class="text-5xl mb-4">📦</div>

                        <h2 class="text-xl font-bold">
                            Estoque
                        </h2>

                    </a>

                </div>

                <div class="mt-10">
                    <h2 class="text-xl font-bold mb-4">Produtos abaixo do estoque mínimo</h2>

                    @if($produtosAbaixoMinimo->isEmpty())
                        <p class="text-gray-600">Nenhum produto está abaixo do estoque mínimo.</p>
                    @else
                        <div class="space-y-3">
                            @foreach($produtosAbaixoMinimo as $produto)
                                <div class="border border-red-200 bg-red-50 rounded-lg p-4">
                                    <div class="flex justify-between items-center gap-4">
                                        <div>
                                            <strong>{{ $produto->nome }}</strong>
                                            <span class="text-gray-500"> | Estoque atual: {{ $produto->estoqueDisponivel() }}</span>
                                        </div>
                                        <span class="px-2 py-1 rounded text-sm font-medium bg-red-100 text-red-700">
                                            Abaixo do mínimo
                                        </span>
                                    </div>
                                    <div class="mt-2 text-sm text-gray-600">
                                        Estoque mínimo: {{ $produto->estoque_minimo ?? 0 }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="mt-10">
                    <h2 class="text-xl font-bold mb-4">Alertas de validade</h2>

                    @if($alertas->isEmpty())
                        <p class="text-gray-600">Nenhum lote com validade próxima ou vencida.</p>
                    @else
                        <div class="space-y-3">
                            @foreach($alertas as $alerta)
                                @php
                                    $situacao = $alerta->situacaoValidade();
                                    $badge = $situacao === 'Vencido'
                                        ? 'bg-red-100 text-red-700'
                                        : 'bg-yellow-100 text-yellow-700';
                                @endphp
                                <div class="border rounded-lg p-4 {{ $situacao === 'Vencido' ? 'border-red-200' : 'border-yellow-200' }}">
                                    <div class="flex justify-between items-center gap-4">
                                        <div>
                                            <strong>{{ $alerta->produto->nome ?? 'Produto' }}</strong>
                                            <span class="text-gray-500"> | Lote {{ $alerta->numero_lote }}</span>
                                        </div>
                                        <span class="px-2 py-1 rounded text-sm font-medium {{ $badge }}">
                                            {{ $situacao }}
                                        </span>
                                    </div>
                                    <div class="mt-2 text-sm text-gray-600">
                                        Quantidade: {{ $alerta->saldoDisponivel() }}
                                        | Validade: {{ $alerta->data_validade }}
                                        | {{ $alerta->textoValidade() }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

            </div>

        </div>

    </div>

</x-app-layout>

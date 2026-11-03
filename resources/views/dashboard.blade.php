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
    <div class="py-8 lg:py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="space-y-8">

                <div class="rounded-[26px] bg-[#0d5b5d] px-6 py-7 shadow-[0_12px_30px_rgba(13,91,93,0.18)] lg:px-8">
                    <div class="flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
                        <div>
                            <p class="text-lg font-semibold text-[#ecf8f7]">Olá, gestor</p>
                            <h1 class="mt-2 max-w-xl text-3xl font-black leading-tight text-white sm:text-4xl lg:text-[3.2rem]">
                                Controle de estoque em<br class="hidden lg:block"> tempo real
                            </h1>
                            <p class="mt-4 max-w-lg text-sm leading-6 text-[#d7eeea] sm:text-base">
                                Acompanhe validade, alertas e produtos em um único painel.
                            </p>
                        </div>

                        <div class="flex flex-wrap items-center gap-3 self-start lg:self-auto">
                            <span class="rounded-xl bg-white/10 px-4 py-2 text-sm font-semibold text-[#f2fffb] backdrop-blur-sm">
                                Estoque saudável
                            </span>
                            <span class="rounded-xl bg-white/10 px-4 py-2 text-sm font-semibold text-[#f2fffb] backdrop-blur-sm">
                                1 lote(s) com saldo
                            </span>
                        </div>
                    </div>
                </div>

                <div class="grid gap-6 xl:grid-cols-[1.4fr_0.8fr]">
                    <div class="rounded-[24px] bg-white p-6 shadow-sm ring-1 ring-black/5">
                        <div class="mb-5 flex items-center justify-between">
                            <h3 class="text-2xl font-black text-[#1d1d1d]">Produtos abaixo do mínimo</h3>
                            <span class="rounded-full bg-[#edf7f6] px-3 py-1 text-xs font-bold uppercase tracking-[0.08em] text-[#0d5b5d]">
                                {{ count($produtosAbaixoMinimo) }} alertas
                            </span>
                        </div>

                        @if($produtosAbaixoMinimo->isEmpty())
                            <p class="text-sm text-[#6b7280]">Nenhum produto está abaixo do estoque mínimo.</p>
                        @else
                            <div class="space-y-3">
                                @foreach($produtosAbaixoMinimo as $produto)
                                    <div class="rounded-2xl border border-[#f1d7db] bg-[#fff5f7] p-4">
                                        <div class="flex items-center justify-between gap-4">
                                            <div>
                                                <strong class="block text-base font-bold text-[#1d1d1d]">{{ $produto->nome }}</strong>
                                                <span class="text-sm text-[#6b7280]">Estoque atual: {{ $produto->estoqueDisponivel() }}</span>
                                            </div>
                                            <span class="rounded-full bg-[#f7dfe6] px-2.5 py-1 text-xs font-bold text-[#b1445a]">
                                                Abaixo do mínimo
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="rounded-[24px] bg-white p-6 shadow-sm ring-1 ring-black/5">
                        <div class="mb-5 flex items-center justify-between">
                            <h3 class="text-2xl font-black text-[#1d1d1d]">Alertas</h3>
                            <span class="rounded-full bg-[#eef5ff] px-3 py-1 text-xs font-bold uppercase tracking-[0.08em] text-[#3d7adf]">
                                {{ $alertas->count() }} itens
                            </span>
                        </div>

                        @if($alertas->isEmpty())
                            <p class="text-sm text-[#6b7280]">Nenhum lote com validade próxima ou vencida.</p>
                        @else
                            <div class="space-y-3">
                                @foreach($alertas as $alerta)
                                    @php
                                        $situacao = $alerta->situacaoValidade();
                                        $badge = $situacao === 'Vencido'
                                            ? 'bg-[#f8dfe4] text-[#b1445a]'
                                            : 'bg-[#fdf1d7] text-[#b67a14]';
                                    @endphp
                                    <div class="rounded-2xl border border-[#edf0f2] bg-[#f8fafb] p-4">
                                        <div class="flex items-start justify-between gap-3">
                                            <div>
                                                <strong class="block text-base font-bold text-[#1d1d1d]">{{ $alerta->produto->nome ?? 'Produto' }}</strong>
                                                <span class="text-sm text-[#6b7280]">Lote {{ $alerta->numero_lote }}</span>
                                            </div>
                                            <span class="rounded-full px-2.5 py-1 text-[10px] font-bold uppercase tracking-[0.08em] {{ $badge }}">
                                                {{ $situacao }}
                                            </span>
                                        </div>
                                        <div class="mt-2 text-xs text-[#5e5e5e]">
                                            Validade: {{ $alerta->data_validade }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

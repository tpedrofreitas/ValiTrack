@php
    $totalCategorias = \App\Models\Categoria::count();
@endphp

<nav x-data="{ open: false }" class="border-b border-[#e8eceb] bg-[#f7f8f7] shadow-sm">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-20 items-center justify-between">
            <div class="flex items-center gap-8">
                <a href="{{ route('dashboard') }}" class="flex items-center">
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#0d5b5d] text-lg font-black text-white">
                            V
                        </div>
                        <span class="text-3xl font-black tracking-tight text-[#1d1d1d]">ValiTrack</span>
                    </div>
                </a>

                <div class="hidden items-center gap-6 md:flex">
                    <a href="{{ route('categoria.index') }}" class="text-sm font-semibold text-[#4a4a4a] transition hover:text-[#0d5b5d]">
                        Categorias
                    </a>
                    @if($totalCategorias > 0)
                        <a href="{{ route('produto.index') }}" class="text-sm font-semibold text-[#4a4a4a] transition hover:text-[#0d5b5d]">
                            Produtos
                        </a>
                    @else
                        <a href="{{ route('categoria.cadastrar') }}" class="text-sm font-semibold text-[#9ca3af] transition hover:text-[#0d5b5d] opacity-70">
                            Produtos
                        </a>
                    @endif
                    <a href="{{ route('fornecedor.index') }}" class="text-sm font-semibold text-[#4a4a4a] transition hover:text-[#0d5b5d]">
                        Fornecedores
                    </a>
                    <a href="{{ route('lote.index') }}" class="text-sm font-semibold text-[#4a4a4a] transition hover:text-[#0d5b5d]">
                        Entradas
                    </a>
                    <a href="{{ route('saida.index') }}" class="text-sm font-semibold text-[#4a4a4a] transition hover:text-[#0d5b5d]">
                        Saídas
                    </a>
                    <a href="{{ route('estoque.index') }}" class="text-sm font-semibold text-[#4a4a4a] transition hover:text-[#0d5b5d]">
                        Estoque
                    </a>
                    <a href="{{ route('relatorio.index') }}" class="text-sm font-semibold text-[#4a4a4a] transition hover:text-[#0d5b5d]">
                        Relatórios
                    </a>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-2 rounded-full border border-[#dfe4e0] bg-white px-3 py-2 text-sm font-semibold text-[#1d1d1d] shadow-sm transition hover:border-[#cfe4e3] hover:text-[#0d5b5d] focus:outline-none">
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center rounded-md p-2 text-[#1d1d1d] hover:bg-[#edf2f1] focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="space-y-1 border-t border-[#e8eceb] bg-white px-4 py-3">
            <a href="{{ route('categoria.index') }}" class="block rounded-lg px-3 py-2 text-sm font-semibold text-[#4a4a4a] hover:bg-[#eef5f4] hover:text-[#0d5b5d]">Categorias</a>
            @if($totalCategorias > 0)
                <a href="{{ route('produto.index') }}" class="block rounded-lg px-3 py-2 text-sm font-semibold text-[#4a4a4a] hover:bg-[#eef5f4] hover:text-[#0d5b5d]">Produtos</a>
            @else
                <a href="{{ route('categoria.cadastrar') }}" class="block rounded-lg px-3 py-2 text-sm font-semibold text-[#9ca3af] hover:bg-[#eef5f4] hover:text-[#0d5b5d]">Produtos</a>
            @endif
            <a href="{{ route('fornecedor.index') }}" class="block rounded-lg px-3 py-2 text-sm font-semibold text-[#4a4a4a] hover:bg-[#eef5f4] hover:text-[#0d5b5d]">Fornecedores</a>
            <a href="{{ route('lote.index') }}" class="block rounded-lg px-3 py-2 text-sm font-semibold text-[#4a4a4a] hover:bg-[#eef5f4] hover:text-[#0d5b5d]">Entradas</a>
            <a href="{{ route('saida.index') }}" class="block rounded-lg px-3 py-2 text-sm font-semibold text-[#4a4a4a] hover:bg-[#eef5f4] hover:text-[#0d5b5d]">Saídas</a>
            <a href="{{ route('estoque.index') }}" class="block rounded-lg px-3 py-2 text-sm font-semibold text-[#4a4a4a] hover:bg-[#eef5f4] hover:text-[#0d5b5d]">Estoque</a>
            <a href="{{ route('relatorio.index') }}" class="block rounded-lg px-3 py-2 text-sm font-semibold text-[#4a4a4a] hover:bg-[#eef5f4] hover:text-[#0d5b5d]">Relatórios</a>
        </div>
    </div>
</nav>

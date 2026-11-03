<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ValiTrack | Controle de Estoque</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#eef4f3] text-[#1d1d1d]">
    <div class="mx-auto flex min-h-screen max-w-7xl items-center justify-center px-4 py-10 sm:px-6 lg:px-8">
        <div class="w-full overflow-hidden rounded-[30px] bg-white shadow-[0_18px_50px_rgba(13,91,93,0.12)] ring-1 ring-black/5">
            <div class="bg-[#0d5b5d] px-6 py-8 sm:px-10 lg:px-14">
                <div class="flex items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-white/10 text-xl font-black text-white shadow-inner">
                            V
                        </div>
                        <span class="text-2xl font-black tracking-tight text-white sm:text-3xl">ValiTrack</span>
                    </div>
                </div>

                <div class="mt-10 grid items-center gap-8 lg:grid-cols-[1.2fr_0.8fr]">
                    <div>
                        <p class="text-lg font-semibold text-[#ebfaf7]">Olá, gestor</p>
                        <h1 class="mt-3 text-4xl font-black leading-tight text-white sm:text-5xl lg:text-6xl">
                            Controle de estoque em<br class="hidden lg:block"> tempo real
                        </h1>
                        <p class="mt-5 max-w-xl text-base leading-7 text-[#d9efec] sm:text-lg">
                            Gerencie produtos, validade, alertas e movimentações em um único painel simples, rápido e eficiente.
                        </p>

                        <div class="mt-8 flex flex-wrap gap-3">
                            <span class="rounded-xl bg-white/10 px-4 py-2 text-sm font-semibold text-[#f2fffb]">Estoque saudável</span>
                            <span class="rounded-xl bg-white/10 px-4 py-2 text-sm font-semibold text-[#f2fffb]">1 lote(s) com saldo</span>
                        </div>
                    </div>

                    <div class="rounded-[26px] bg-white/10 p-5 backdrop-blur-sm ring-1 ring-white/10">
                        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-1">
                            <div class="rounded-2xl bg-[#eefaf8] p-4">
                                <div class="text-sm font-semibold text-[#0d5b5d]">Produtos</div>
                                <div class="mt-2 text-3xl font-black text-[#0d5b5d]">1</div>
                                <div class="mt-1 text-sm text-[#4d6d6d]">ativos no catálogo</div>
                            </div>
                            <div class="rounded-2xl bg-[#fff4f6] p-4">
                                <div class="text-sm font-semibold text-[#b1445a]">Vencidos</div>
                                <div class="mt-2 text-3xl font-black text-[#b1445a]">0</div>
                                <div class="mt-1 text-sm text-[#7a5960]">lotes vencidos</div>
                            </div>
                            <div class="rounded-2xl bg-[#edf4ff] p-4">
                                <div class="text-sm font-semibold text-[#3d7adf]">Validade</div>
                                <div class="mt-2 text-3xl font-black text-[#3d7adf]">36 dias</div>
                                <div class="mt-1 text-sm text-[#5874a5]">prazo mais próximo</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-[#f7f9f8] px-6 py-10 sm:px-10 lg:px-14">
                <div class="grid gap-6 md:grid-cols-3">
                    <div class="rounded-[22px] bg-[#edf5f4] p-6 text-center shadow-sm ring-1 ring-black/5">
                        <div class="text-5xl">📦</div>
                        <h2 class="mt-4 text-2xl font-black text-[#1d1d1d]">Produtos</h2>
                        <p class="mt-2 text-sm leading-6 text-[#5c6466]">Cadastro e gerenciamento completo de produtos.</p>
                    </div>

                    <div class="rounded-[22px] bg-[#eef7ee] p-6 text-center shadow-sm ring-1 ring-black/5">
                        <div class="text-5xl">📁</div>
                        <h2 class="mt-4 text-2xl font-black text-[#1d1d1d]">Categorias</h2>
                        <p class="mt-2 text-sm leading-6 text-[#5c6466]">Organize os itens por categoria e mantenha a rotina clara.</p>
                    </div>

                    <div class="rounded-[22px] bg-[#fff6e8] p-6 text-center shadow-sm ring-1 ring-black/5">
                        <div class="text-5xl">📊</div>
                        <h2 class="mt-4 text-2xl font-black text-[#1d1d1d]">Relatórios</h2>
                        <p class="mt-2 text-sm leading-6 text-[#5c6466]">Acompanhe validade, estoque e alertas rapidamente.</p>
                    </div>
                </div>

                <div class="mt-10 text-center">
                    @auth
                        <a href="{{ route('dashboard') }}"
                           class="inline-flex items-center justify-center rounded-xl bg-[#0d5b5d] px-8 py-3 text-lg font-bold text-white shadow-[0_10px_25px_rgba(13,91,93,0.25)] transition hover:bg-[#0b4f50]">
                            Entrar no Sistema
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="inline-flex items-center justify-center rounded-xl bg-[#0d5b5d] px-8 py-3 text-lg font-bold text-white shadow-[0_10px_25px_rgba(13,91,93,0.25)] transition hover:bg-[#0b4f50]">
                            Fazer Login
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</body>

</html>
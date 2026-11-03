
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ValiTrack - {{ config('app.name', 'Sistema') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Figtree', sans-serif;
        }

        .auth-background {
            background: linear-gradient(
                160deg,
                #102a35 0%,
                #124b4c 45%,
                #198c75 100%
            );
        }

        .auth-card {
            background: #eff6f2;
            border-radius: 26px;
            box-shadow: 0 15px 45px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>

<body class="antialiased">

    <main class="auth-background min-h-screen flex items-center justify-center px-5 py-10">

        <div class="w-full max-w-sm">

            <section class="auth-card px-6 py-8 sm:px-7">

                <!-- Ícone -->
                <div class="flex justify-center mb-5">

                    <div class="w-[76px] h-[76px] rounded-3xl
                                bg-[#d7ebe4] flex items-center justify-center">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-9 h-9 text-[#20977f]"
                             viewBox="0 0 24 24"
                             fill="currentColor">

                            <path d="M20 3H4C2.9 3 2 3.9 2 5v14c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-1 5H5V5h14v3zm-3 7H8v-2h8v2z"/>
                        </svg>

                    </div>

                </div>

                <!-- Identidade do sistema -->
                <div class="text-center mb-6">

                    <h1 class="text-[28px] font-extrabold text-[#1b3038]">
                        ValiTrack
                    </h1>

                    <p class="text-sm text-[#71848b] mt-1">
                        Acesse sua conta
                    </p>

                </div>

                <!-- Conteúdo de autenticação -->
                <div>
                    {{ $slot }}
                </div>

            </section>

        </div>

    </main>

</body>
</html>

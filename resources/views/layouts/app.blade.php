<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        {{-- Botões customizados (independentes do Tailwind) --}}
        <style>
            .btn-primary-custom {
                background-color: #4f46e5; /* roxo/azul */
                color: #ffffff;
                border-radius: 0.5rem;
                padding: 0.5rem 1rem;
                font-size: 0.75rem;
                font-weight: 600;
                text-transform: uppercase;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 0.25rem;
                border: none;
                box-shadow: 0 1px 2px rgba(15, 23, 42, 0.15);
                cursor: pointer;
            }

            .btn-primary-custom:hover {
                background-color: #4338ca;
            }

            .btn-chip-secondary {
                background-color: #e0f2fe; /* azul clarinho */
                color: #0369a1;
                border-radius: 0.5rem;
                padding: 0.5rem 1rem;
                font-size: 0.75rem;
                font-weight: 600;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 0.25rem;
                border: 1px solid #bae6fd;
                box-shadow: 0 1px 2px rgba(15, 23, 42, 0.05);
                cursor: pointer;
            }

            .btn-chip-secondary:hover {
                background-color: #bae6fd;
            }

            /* Campos de formulário sempre claros */
            input[type="text"],
            input[type="number"],
            input[type="email"],
            input[type="password"],
            input[type="date"] {
                background-color: #ffffff;
                color: #111827;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            {{-- Topo com navegação --}}
            @include('layouts.navigation')

            {{-- Cabeçalho (título / subtítulo da página) --}}
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            {{-- Conteúdo --}}
            <main class="py-6">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>

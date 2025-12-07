<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                    Painel da Livraria
                </h2>
                <p class="text-sm text-gray-500">
                    Visão geral dos clientes, livros e empréstimos.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Cards de resumo --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white shadow-sm rounded-2xl p-5 border border-gray-100">
                    <div class="text-sm font-medium text-gray-500">
                        Clientes
                    </div>
                    <div class="mt-2 text-3xl font-semibold text-gray-900">
                        {{ $totalClientes }}
                    </div>
                    <p class="mt-1 text-xs text-gray-500">
                        Pessoas cadastradas na livraria.
                    </p>
                </div>

                <div class="bg-white shadow-sm rounded-2xl p-5 border border-gray-100">
                    <div class="text-sm font-medium text-gray-500">
                        Livros
                    </div>
                    <div class="mt-2 text-3xl font-semibold text-gray-900">
                        {{ $totalLivros }}
                    </div>
                    <p class="mt-1 text-xs text-gray-500">
                        Títulos disponíveis no acervo.
                    </p>
                </div>

                <div class="bg-white shadow-sm rounded-2xl p-5 border border-gray-100">
                    <div class="text-sm font-medium text-gray-500">
                        Empréstimos (total)
                    </div>
                    <div class="mt-2 text-3xl font-semibold text-gray-900">
                        {{ $totalEmprestimos }}
                    </div>
                    <p class="mt-1 text-xs text-gray-500">
                        Registros já realizados.
                    </p>
                </div>

                <div class="bg-white shadow-sm rounded-2xl p-5 border border-gray-100">
                    <div class="text-sm font-medium text-gray-500">
                        Empréstimos em aberto
                    </div>
                    <div class="mt-2 text-3xl font-semibold text-indigo-600">
                        {{ $emprestimosAbertos }}
                    </div>
                    <p class="mt-1 text-xs text-gray-500">
                        Aguardando devolução.
                    </p>
                </div>
            </div>

            {{-- Últimos empréstimos --}}
            <div class="bg-white shadow-sm rounded-2xl p-6 border border-gray-100">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">
                            Últimos empréstimos
                        </h3>
                        <p class="text-xs text-gray-500">
                            Registros mais recentes realizados no sistema.
                        </p>
                    </div>
                    <a href="{{ route('emprestimos.index') }}"
                       class="text-sm text-indigo-600 hover:underline">
                        Ver todos
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="border-b border-gray-200 bg-gray-50">
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Cliente</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Livro</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Empréstimo</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Prev. devolução</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($ultimosEmprestimos as $emprestimo)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-2 text-gray-800">
                                        {{ $emprestimo->client->nome }}
                                    </td>
                                    <td class="px-4 py-2 text-gray-800">
                                        {{ $emprestimo->book->titulo }}
                                    </td>
                                    <td class="px-4 py-2 text-gray-700">
                                        {{ \Carbon\Carbon::parse($emprestimo->data_emprestimo)->format('d/m/Y') }}
                                    </td>
                                    <td class="px-4 py-2 text-gray-700">
                                        {{ \Carbon\Carbon::parse($emprestimo->data_prevista_devolucao)->format('d/m/Y') }}
                                    </td>
                                    <td class="px-4 py-2">
                                        @if ($emprestimo->status === 'aberto')
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                                Aberto
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                                Devolvido
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-4 text-center text-gray-500">
                                        Nenhum empréstimo registrado ainda.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

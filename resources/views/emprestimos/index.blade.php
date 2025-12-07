<x-app-layout>
    <x-slot name="header">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Empréstimos
            </h2>
            <p class="text-sm text-gray-500">
                Controle de empréstimos de livros para os clientes.
            </p>
        </div>

        <div class="flex space-x-3">
            <a href="{{ route('emprestimos.relatorio.pdf') }}" class="btn-chip-secondary">
                Relatório PDF
            </a>

            <a href="{{ route('emprestimos.create') }}" class="btn-primary-custom">
                + Novo Empréstimo
            </a>
        </div>
    </div>
</x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mt-4">
            @if (session('success'))
                <div class="mb-4 rounded-md bg-emerald-50 px-4 py-2 text-sm text-emerald-800 border border-emerald-100">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Cliente</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Livro</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Empréstimo</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Prev. Devolução</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($emprestimos as $emprestimo)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 text-gray-700">{{ $emprestimo->client->nome }}</td>
                                <td class="px-4 py-2 text-gray-700">{{ $emprestimo->book->titulo }}</td>
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
                                <td class="px-4 py-2 text-right text-xs">
                                    <div class="inline-flex items-center gap-3">
                                        <a href="{{ route('emprestimos.show', $emprestimo) }}"
                                           class="text-indigo-600 hover:underline">
                                            Ver
                                        </a>
                                        <a href="{{ route('emprestimos.edit', $emprestimo) }}"
                                           class="text-yellow-600 hover:underline">
                                            Editar
                                        </a>
                                        <form action="{{ route('emprestimos.destroy', $emprestimo) }}"
                                              method="POST"
                                              onsubmit="return confirm('Deseja realmente excluir este empréstimo?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="text-red-600 hover:underline">
                                                Excluir
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-4 text-center text-gray-500">
                                    Nenhum empréstimo registrado.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="p-4">
                    {{ $emprestimos->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

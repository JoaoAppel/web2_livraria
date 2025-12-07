<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalhes do Empréstimo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 space-y-4">
                <div>
                    <span class="font-semibold text-gray-700">Cliente:</span>
                    <span class="text-gray-800">{{ $emprestimo->client->nome }}</span>
                </div>

                <div>
                    <span class="font-semibold text-gray-700">Livro:</span>
                    <span class="text-gray-800">{{ $emprestimo->book->titulo }}</span>
                </div>

                <div>
                    <span class="font-semibold text-gray-700">Data empréstimo:</span>
                    <span class="text-gray-800">
                        {{ \Carbon\Carbon::parse($emprestimo->data_emprestimo)->format('d/m/Y') }}
                    </span>
                </div>

                <div>
                    <span class="font-semibold text-gray-700">Data prevista para devolução:</span>
                    <span class="text-gray-800">
                        {{ \Carbon\Carbon::parse($emprestimo->data_prevista_devolucao)->format('d/m/Y') }}
                    </span>
                </div>

                <div>
                    <span class="font-semibold text-gray-700">Data da devolução:</span>
                    <span class="text-gray-800">
                        @if ($emprestimo->data_devolucao)
                            {{ \Carbon\Carbon::parse($emprestimo->data_devolucao)->format('d/m/Y') }}
                        @else
                            -
                        @endif
                    </span>
                </div>

                <div>
                    <span class="font-semibold text-gray-700">Status:</span>
                    @if ($emprestimo->status === 'aberto')
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                            Aberto
                        </span>
                    @else
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                            Devolvido
                        </span>
                    @endif
                </div>

                <div class="pt-4 flex space-x-2">
                    <a href="{{ route('emprestimos.edit', $emprestimo) }}"
                       class="px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600">
                        Editar
                    </a>
                    <a href="{{ route('emprestimos.index') }}"
                       class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md">
                        Voltar
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

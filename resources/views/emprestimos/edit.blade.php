<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Editar Empréstimo
            </h2>
            <p class="text-sm text-gray-500">
                Atualização dos dados do empréstimo selecionado.
            </p>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if ($errors->any())
                        <div class="mb-4 text-sm text-red-600">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('emprestimos.update', $emprestimo) }}">
                        @csrf
                        @method('PUT')

                        {{-- Cliente (somente leitura) --}}
                        <div class="mb-4">
                            <x-input-label value="Cliente" />
                            <p class="mt-1 text-gray-900 font-medium">
                                {{ $emprestimo->client->nome }}
                            </p>
                        </div>

                        {{-- Livro (somente leitura) --}}
                        <div class="mb-4">
                            <x-input-label value="Livro" />
                            <p class="mt-1 text-gray-900 font-medium">
                                {{ $emprestimo->book->titulo }}
                            </p>
                        </div>

                        {{-- Data do empréstimo (somente leitura) --}}
                        <div class="mb-4">
                            <x-input-label value="Data do empréstimo" />
                            <p class="mt-1 text-gray-900">
                                {{ \Carbon\Carbon::parse($emprestimo->data_emprestimo)->format('d/m/Y') }}
                            </p>
                        </div>

                        {{-- Data prevista de devolução (somente leitura) --}}
                        <div class="mb-4">
                            <x-input-label value="Data prevista de devolução" />
                            <p class="mt-1 text-gray-900">
                                {{ \Carbon\Carbon::parse($emprestimo->data_prevista_devolucao)->format('d/m/Y') }}
                            </p>
                        </div>

                        {{-- Data de devolução efetiva (editável) --}}
                        <div class="mb-4">
                            <x-input-label for="data_devolucao" value="Data de devolução efetiva" />
                            <x-text-input
                                id="data_devolucao"
                                name="data_devolucao"
                                type="date"
                                class="mt-1 block w-full"
                                :value="old('data_devolucao', $emprestimo->data_devolucao)"
                            />
                            <x-input-error :messages="$errors->get('data_devolucao')" class="mt-2" />
                        </div>

                        {{-- Status (editável) --}}
                        <div class="mb-4">
                            <x-input-label for="status" value="Status" />
                            <select
                                id="status"
                                name="status"
                                class="mt-1 block w-full rounded-md border border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 focus:ring-2 focus:ring-offset-0"
                                required
                            >
                                <option value="aberto" @selected(old('status', $emprestimo->status) === 'aberto')>
                                    Aberto
                                </option>
                                <option value="devolvido" @selected(old('status', $emprestimo->status) === 'devolvido')>
                                    Devolvido
                                </option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <div class="flex justify-end gap-2 mt-4">
                            <a href="{{ route('emprestimos.index') }}" class="btn-chip-secondary">
                                Cancelar
                            </a>

                            <x-primary-button>
                                Atualizar
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

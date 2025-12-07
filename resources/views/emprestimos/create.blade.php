<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Novo Empréstimo
            </h2>
            <p class="text-sm text-gray-500">
                Registro de um novo empréstimo de livro para um cliente.
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

                    <form method="POST" action="{{ route('emprestimos.store') }}">
                        @csrf

                        {{-- Cliente --}}
                        <div class="mb-4">
                            <x-input-label for="client_id" value="Cliente" />
                            <select
                                id="client_id"
                                name="client_id"
                                class="mt-1 block w-full rounded-md border border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 focus:ring-2 focus:ring-offset-0"
                                required
                            >
                                <option value="">Selecione um cliente</option>
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}"
                                        @selected(old('client_id') == $cliente->id)>
                                        {{ $cliente->nome }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('client_id')" class="mt-2" />
                        </div>

                        {{-- Livro --}}
                        <div class="mb-4">
                            <x-input-label for="book_id" value="Livro" />
                            <select
                                id="book_id"
                                name="book_id"
                                class="mt-1 block w-full rounded-md border border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 focus:ring-2 focus:ring-offset-0"
                                required
                            >
                                <option value="">Selecione um livro</option>
                                @foreach ($livros as $livro)
                                    <option value="{{ $livro->id }}"
                                        @selected(old('book_id') == $livro->id)>
                                        {{ $livro->titulo }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('book_id')" class="mt-2" />
                        </div>

                        {{-- Data do empréstimo --}}
                        <div class="mb-4">
                            <x-input-label for="data_emprestimo" value="Data do empréstimo" />
                            <x-text-input
                                id="data_emprestimo"
                                name="data_emprestimo"
                                type="date"
                                class="mt-1 block w-full"
                                :value="old('data_emprestimo', now()->format('Y-m-d'))"
                                required
                            />
                            <x-input-error :messages="$errors->get('data_emprestimo')" class="mt-2" />
                        </div>

                        {{-- Data prevista de devolução --}}
                        <div class="mb-4">
                            <x-input-label for="data_prevista_devolucao" value="Data prevista de devolução" />
                            <x-text-input
                                id="data_prevista_devolucao"
                                name="data_prevista_devolucao"
                                type="date"
                                class="mt-1 block w-full"
                                :value="old('data_prevista_devolucao')"
                                required
                            />
                            <x-input-error :messages="$errors->get('data_prevista_devolucao')" class="mt-2" />
                        </div>

                        <div class="flex justify-end gap-2 mt-4">
                            <a href="{{ route('emprestimos.index') }}" class="btn-chip-secondary">
                                Cancelar
                            </a>

                            <x-primary-button>
                                Salvar
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

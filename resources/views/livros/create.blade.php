<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Novo Livro
            </h2>
            <p class="text-sm text-gray-500">
                Cadastro de um novo livro no acervo.
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

                    <form method="POST" action="{{ route('livros.store') }}">
                        @csrf

                        {{-- Título --}}
                        <div class="mb-4">
                            <x-input-label for="titulo" value="Título" />
                            <x-text-input
                                id="titulo"
                                name="titulo"
                                type="text"
                                class="mt-1 block w-full"
                                :value="old('titulo')"
                                required
                            />
                            <x-input-error :messages="$errors->get('titulo')" class="mt-2" />
                        </div>

                        {{-- Autor --}}
                        <div class="mb-4">
                            <x-input-label for="autor" value="Autor" />
                            <x-text-input
                                id="autor"
                                name="autor"
                                type="text"
                                class="mt-1 block w-full"
                                :value="old('autor')"
                                required
                            />
                            <x-input-error :messages="$errors->get('autor')" class="mt-2" />
                        </div>

                        {{-- Ano de publicação --}}
                        <div class="mb-4">
                            <x-input-label for="ano_publicacao" value="Ano de publicação" />
                            <x-text-input
                                id="ano_publicacao"
                                name="ano_publicacao"
                                type="number"
                                class="mt-1 block w-full"
                                :value="old('ano_publicacao')"
                                required
                            />
                            <x-input-error :messages="$errors->get('ano_publicacao')" class="mt-2" />
                        </div>

                        {{-- Quantidade total --}}
                        <div class="mb-4">
                            <x-input-label for="quantidade_total" value="Quantidade total" />
                            <x-text-input
                                id="quantidade_total"
                                name="quantidade_total"
                                type="number"
                                min="0"
                                class="mt-1 block w-full"
                                :value="old('quantidade_total')"
                                required
                            />
                            <x-input-error :messages="$errors->get('quantidade_total')" class="mt-2" />
                        </div>

                        {{-- Quantidade disponível --}}
                        <div class="mb-4">
                            <x-input-label for="quantidade_disponivel" value="Quantidade disponível" />
                            <x-text-input
                                id="quantidade_disponivel"
                                name="quantidade_disponivel"
                                type="number"
                                min="0"
                                class="mt-1 block w-full"
                                :value="old('quantidade_disponivel')"
                                required
                            />
                            <x-input-error :messages="$errors->get('quantidade_disponivel')" class="mt-2" />
                        </div>

                        <div class="flex justify-end gap-2 mt-4">
                            <a href="{{ route('livros.index') }}" class="btn-chip-secondary">
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

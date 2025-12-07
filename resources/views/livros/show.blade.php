<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalhes do Livro') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 space-y-4">
                <div>
                    <span class="font-semibold text-gray-700">Título:</span>
                    <span class="text-gray-800">{{ $livro->titulo }}</span>
                </div>

                <div>
                    <span class="font-semibold text-gray-700">Autor:</span>
                    <span class="text-gray-800">{{ $livro->autor }}</span>
                </div>

                <div>
                    <span class="font-semibold text-gray-700">Ano de publicação:</span>
                    <span class="text-gray-800">{{ $livro->ano_publicacao }}</span>
                </div>

                <div>
                    <span class="font-semibold text-gray-700">ISBN:</span>
                    <span class="text-gray-800">{{ $livro->isbn }}</span>
                </div>

                <div>
                    <span class="font-semibold text-gray-700">Quantidade total:</span>
                    <span class="text-gray-800">{{ $livro->quantidade_total }}</span>
                </div>

                <div>
                    <span class="font-semibold text-gray-700">Quantidade disponível:</span>
                    <span class="text-gray-800">{{ $livro->quantidade_disponivel }}</span>
                </div>

                <div class="pt-4 flex space-x-2">
                    <x-primary-link href="{{ route('livros.edit', $livro) }}">
                        Editar
                    </x-primary-link>
                    <x-secondary-link href="{{ route('livros.index') }}">
                        Voltar
                    </x-secondary-link>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

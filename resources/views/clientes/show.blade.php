<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalhes do Cliente') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 space-y-4">
                <div>
                    <span class="font-semibold text-gray-700">Nome:</span>
                    <span class="text-gray-800">{{ $cliente->nome }}</span>
                </div>

                <div>
                    <span class="font-semibold text-gray-700">E-mail:</span>
                    <span class="text-gray-800">{{ $cliente->email }}</span>
                </div>

                <div>
                    <span class="font-semibold text-gray-700">Telefone:</span>
                    <span class="text-gray-800">{{ $cliente->telefone }}</span>
                </div>

                <div class="pt-4 flex space-x-2">
                    <a href="{{ route('clientes.edit', $cliente) }}"
                       class="px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600">
                        Editar
                    </a>
                    <a href="{{ route('clientes.index') }}"
                       class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md">
                        Voltar
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

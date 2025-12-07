<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Novo Cliente
            </h2>
            <p class="text-sm text-gray-500">
                Cadastro de clientes da livraria.
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

                    <form method="POST" action="{{ route('clientes.store') }}">
                        @csrf

                        {{-- Nome --}}
                        <div class="mb-4">
                            <x-input-label for="nome" value="Nome" />
                            <x-text-input
                                id="nome"
                                name="nome"
                                type="text"
                                class="mt-1 block w-full"
                                :value="old('nome')"
                                required
                            />
                            <x-input-error :messages="$errors->get('nome')" class="mt-2" />
                        </div>

                        {{-- E-mail --}}
                        <div class="mb-4">
                            <x-input-label for="email" value="E-mail" />
                            <x-text-input
                                id="email"
                                name="email"
                                type="email"
                                class="mt-1 block w-full"
                                :value="old('email')"
                                required
                            />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        {{-- Telefone --}}
                        <div class="mb-4">
                            <x-input-label for="telefone" value="Telefone" />
                            <x-text-input
                                id="telefone"
                                name="telefone"
                                type="text"
                                class="mt-1 block w-full"
                                :value="old('telefone')"
                                required
                            />
                            <x-input-error :messages="$errors->get('telefone')" class="mt-2" />
                        </div>

                        <div class="flex justify-end gap-2 mt-4">
                            <a href="{{ route('clientes.index') }}" class="btn-chip-secondary">
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

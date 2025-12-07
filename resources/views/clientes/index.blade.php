<x-app-layout>
    <x-slot name="header">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Clientes
            </h2>
            <p class="text-sm text-gray-500">
                Cadastro de clientes da livraria.
            </p>
        </div>

        {{-- Botão de novo cliente usando o mesmo estilo do primary --}}
        <a href="{{ route('clientes.create') }}" class="btn-primary-custom">
            + Novo Cliente
        </a>
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
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nome</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">E-mail</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Telefone</th>
                            <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($clientes as $cliente)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 text-gray-700">{{ $cliente->id }}</td>
                                <td class="px-4 py-2 text-gray-700">{{ $cliente->nome }}</td>
                                <td class="px-4 py-2 text-gray-700">{{ $cliente->email }}</td>
                                <td class="px-4 py-2 text-gray-700">{{ $cliente->telefone }}</td>
                                <td class="px-4 py-2 text-right text-xs">
                                    <div class="inline-flex items-center gap-3">
                                        <a href="{{ route('clientes.show', $cliente) }}"
                                           class="text-indigo-600 hover:underline">
                                            Ver
                                        </a>
                                        <a href="{{ route('clientes.edit', $cliente) }}"
                                           class="text-yellow-600 hover:underline">
                                            Editar
                                        </a>
                                        <form action="{{ route('clientes.destroy', $cliente) }}"
                                              method="POST"
                                              onsubmit="return confirm('Deseja realmente excluir este cliente?')">
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
                                <td colspan="5" class="px-4 py-4 text-center text-gray-500">
                                    Nenhum cliente cadastrado.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="p-4">
                    {{ $clientes->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

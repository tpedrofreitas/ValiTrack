<x-app-layout>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Fornecedores
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">

                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold">Lista de Fornecedores</h1>

                    <a href="{{ route('fornecedor.cadastrar') }}"
                       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Novo Fornecedor
                    </a>
                </div>

                <table class="min-w-full border">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border p-2">ID</th>
                            <th class="border p-2">Nome</th>
                            <th class="border p-2">Contato</th>
                            <th class="border p-2">Telefone</th>
                            <th class="border p-2">Email</th>
                            <th class="border p-2">CNPJ</th>
                            <th class="border p-2">Endereço</th>
                            <th class="border p-2">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($fornecedores as $fornecedor)
                            <tr>
                                <td class="border p-2">{{ $fornecedor->id }}</td>
                                <td class="border p-2">{{ $fornecedor->nome }}</td>
                                <td class="border p-2">{{ $fornecedor->contato }}</td>
                                <td class="border p-2">{{ $fornecedor->telefone }}</td>
                                <td class="border p-2">{{ $fornecedor->email }}</td>
                                <td class="border p-2">{{ $fornecedor->cnpj }}</td>
                                <td class="border p-2">{{ $fornecedor->endereco }}</td>
                                <td class="border p-2">
                                    <div class="flex gap-2">
                                        <a href="{{ route('fornecedor.editar', $fornecedor->id) }}"
                                           class="bg-gray-300 px-3 py-2 rounded">
                                            Editar
                                        </a>

                                        <form action="{{ route('fornecedor.excluir', $fornecedor->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="bg-red-300 px-3 py-2 rounded"
                                                    onclick="return confirm('Deseja realmente excluir este fornecedor?')">
                                                Excluir
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center p-4">
                                    Nenhum fornecedor cadastrado.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>

</x-app-layout>

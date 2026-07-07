<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Nova Categoria
        </h2>
    </x-slot>

    <div class="py-6">

        <div class="max-w-3xl mx-auto">

            <div class="bg-white shadow rounded-lg p-6">

                <form action="{{ route('categoria.salvar') }}" method="POST">

                    @csrf

                    <div class="mb-4">

                        <label class="block font-medium mb-2">
                            Nome
                        </label>

                        <input
                            type="text"
                            name="nome"
                            class="w-full border rounded-lg p-2"
                            value="{{ old('nome') }}">

                        @error('nome')
                            <p class="text-red-600">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="mb-4">

                        <label class="block font-medium mb-2">
                            Descrição
                        </label>

                        <textarea
                            name="descricao"
                            rows="4"
                            class="w-full border rounded-lg p-2">{{ old('descricao') }}</textarea>

                        @error('descricao')
                            <p class="text-red-600">{{ $message }}</p>
                        @enderror

                    </div>

                    <button
                        class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">

                        Salvar Categoria

                    </button>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>
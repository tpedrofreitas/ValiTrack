<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Nova Categoria
        </h2>
    </x-slot>

    <div class="py-6">

        <div class="max-w-3xl mx-auto">

            <div class="bg-white shadow rounded-lg p-6">

                @if(session('warning'))
                    <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-4">
                        {{ session('warning') }}
                    </div>
                @endif

                <form action="{{ route('categoria.salvar') }}" method="POST">

                    @csrf

                    @include('categorias.form')

                </form>

            </div>

        </div>

    </div>

</x-app-layout>
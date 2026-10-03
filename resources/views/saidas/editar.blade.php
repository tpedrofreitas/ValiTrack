<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Editar Saída
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">

                <form action="{{ route('saida.atualizar', $saida->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @include('saidas.form')
                </form>

            </div>
        </div>
    </div>

</x-app-layout>

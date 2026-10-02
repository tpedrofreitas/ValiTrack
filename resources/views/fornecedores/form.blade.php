<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="mb-4">
        <label for="nome" class="block font-medium mb-2">Nome</label>
        <input type="text" name="nome" id="nome" class="w-full border rounded px-3 py-2" value="{{ old('nome', $fornecedor->nome) }}">
        @error('nome')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="contato" class="block font-medium mb-2">Contato</label>
        <input type="text" name="contato" id="contato" class="w-full border rounded px-3 py-2" value="{{ old('contato', $fornecedor->contato) }}">
        @error('contato')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="telefone" class="block font-medium mb-2">Telefone</label>
        <input type="text" name="telefone" id="telefone" class="w-full border rounded px-3 py-2" value="{{ old('telefone', $fornecedor->telefone) }}">
        @error('telefone')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="email" class="block font-medium mb-2">E-mail</label>
        <input type="email" name="email" id="email" class="w-full border rounded px-3 py-2" value="{{ old('email', $fornecedor->email) }}">
        @error('email')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4 md:col-span-2">
        <label for="cnpj" class="block font-medium mb-2">CNPJ</label>
        <input type="text" name="cnpj" id="cnpj" class="w-full border rounded px-3 py-2" value="{{ old('cnpj', $fornecedor->cnpj) }}">
        @error('cnpj')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4 md:col-span-2">
        <label for="endereco" class="block font-medium mb-2">Endereço</label>
        <textarea name="endereco" id="endereco" rows="4" class="w-full border rounded px-3 py-2">{{ old('endereco', $fornecedor->endereco) }}</textarea>
        @error('endereco')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="flex gap-2 mt-4">
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Salvar Fornecedor
    </button>

    <a href="{{ route('fornecedor.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
        Voltar
    </a>
</div>

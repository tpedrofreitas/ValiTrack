<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="mb-4">
        <label for="produto_id" class="block font-medium mb-2">Produto</label>
        <select name="produto_id" id="produto_id" class="w-full border rounded px-3 py-2">
            <option value="">Selecione um produto</option>
            @foreach($produtos as $produto)
                <option value="{{ $produto->id }}" {{ old('produto_id', $lote->produto_id ?? '') == $produto->id ? 'selected' : '' }}>
                    {{ $produto->nome }}
                </option>
            @endforeach
        </select>
        @error('produto_id')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="fornecedor_id" class="block font-medium mb-2">Fornecedor</label>
        <select name="fornecedor_id" id="fornecedor_id" class="w-full border rounded px-3 py-2">
            <option value="">Selecione um fornecedor</option>
            @foreach($fornecedores as $fornecedor)
                <option value="{{ $fornecedor->id }}" {{ old('fornecedor_id', $lote->fornecedor_id ?? '') == $fornecedor->id ? 'selected' : '' }}>
                    {{ $fornecedor->nome }}
                </option>
            @endforeach
        </select>
        @error('fornecedor_id')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="numero_lote" class="block font-medium mb-2">Número do Lote</label>
        <input type="text" name="numero_lote" id="numero_lote" class="w-full border rounded px-3 py-2" value="{{ old('numero_lote', $lote->numero_lote ?? '') }}">
        @error('numero_lote')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="quantidade" class="block font-medium mb-2">Quantidade</label>
        <input type="number" name="quantidade" id="quantidade" class="w-full border rounded px-3 py-2" value="{{ old('quantidade', $lote->quantidade ?? '') }}">
        @error('quantidade')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="data_fabricação" class="block font-medium mb-2">Data de Fabricação</label>
        <input type="date" name="data_fabricação" id="data_fabricação" class="w-full border rounded px-3 py-2" value="{{ old('data_fabricação', $lote->{'data_fabricação'} ?? '') }}">
        @error('data_fabricação')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="data_validade" class="block font-medium mb-2">Data de Validade</label>
        <input type="date" name="data_validade" id="data_validade" class="w-full border rounded px-3 py-2" value="{{ old('data_validade', $lote->data_validade ?? '') }}">
        @error('data_validade')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="data_entrada" class="block font-medium mb-2">Data de Entrada</label>
        <input type="date" name="data_entrada" id="data_entrada" class="w-full border rounded px-3 py-2" value="{{ old('data_entrada', $lote->data_entrada ?? now()->format('Y-m-d')) }}">
        @error('data_entrada')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="valor_unitario" class="block font-medium mb-2">Valor Unitário</label>
        <input type="number" step="0.01" name="valor_unitario" id="valor_unitario" class="w-full border rounded px-3 py-2" value="{{ old('valor_unitario', $lote->valor_unitario ?? '') }}">
        @error('valor_unitario')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4 md:col-span-2">
        <label for="observacao" class="block font-medium mb-2">Observação</label>
        <textarea name="observacao" id="observacao" rows="4" class="w-full border rounded px-3 py-2">{{ old('observacao', $lote->observacao ?? '') }}</textarea>
        @error('observacao')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="flex gap-2 mt-4">
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Salvar Entrada
    </button>

    <a href="{{ route('lote.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
        Voltar
    </a>
</div>

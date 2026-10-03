<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="mb-4">
        <label for="produto_id" class="block font-medium mb-2">Produto</label>
        <select name="produto_id" id="produto_id" class="w-full border rounded px-3 py-2">
            <option value="">Selecione um produto</option>
            @foreach($produtos as $produto)
                <option value="{{ $produto->id }}" {{ old('produto_id', $saida->produto_id ?? '') == $produto->id ? 'selected' : '' }}>
                    {{ $produto->nome }}
                </option>
            @endforeach
        </select>
        @error('produto_id')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="lote_id" class="block font-medium mb-2">Lote</label>
        <select name="lote_id" id="lote_id" class="w-full border rounded px-3 py-2">
            <option value="">Selecione um lote</option>
            @foreach($lotes as $lote)
                <option value="{{ $lote->id }}" {{ old('lote_id', $saida->lote_id ?? '') == $lote->id ? 'selected' : '' }}>
                    {{ $lote->numero_lote }} - {{ $lote->produto->nome ?? 'Produto' }}
                </option>
            @endforeach
        </select>
        @error('lote_id')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="quantidade" class="block font-medium mb-2">Quantidade</label>
        <input type="number" name="quantidade" id="quantidade" class="w-full border rounded px-3 py-2" value="{{ old('quantidade', $saida->quantidade ?? '') }}">
        @error('quantidade')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="data_saida" class="block font-medium mb-2">Data da Saída</label>
        <input type="date" name="data_saida" id="data_saida" class="w-full border rounded px-3 py-2" value="{{ old('data_saida', $saida->data_saida ?? now()->format('Y-m-d')) }}">
        @error('data_saida')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4 md:col-span-2">
        <label for="motivo" class="block font-medium mb-2">Motivo</label>
        <input type="text" name="motivo" id="motivo" class="w-full border rounded px-3 py-2" value="{{ old('motivo', $saida->motivo ?? '') }}" placeholder="Ex: Venda, perda, transferência...">
        @error('motivo')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4 md:col-span-2">
        <label for="observacao" class="block font-medium mb-2">Observação</label>
        <textarea name="observacao" id="observacao" rows="4" class="w-full border rounded px-3 py-2">{{ old('observacao', $saida->observacao ?? '') }}</textarea>
        @error('observacao')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="flex gap-2 mt-4">
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Salvar Saída
    </button>

    <a href="{{ route('saida.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
        Voltar
    </a>
</div>

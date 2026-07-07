

<div class="max-w-2xl mx-auto bg-gray-400 p-8 rounded-lg shadow-md">

    <div class="mb-5">
        <label for="categoria_id" class="block text-sm font-medium text-gray-700 mb-2">
            Categoria
        </label>

        <select name="categoria_id" id="categoria_id"
            class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-300 outline-none">
            <option value="">Selecione uma categoria</option>
            <option value="1">Carne</option>
            <option value="2">Bebidas</option>
            <option value="3">Hortifruti</option>
            <option value="4">Higiene Pessoal</option>
            <option value="5">Utilidades Doméstica</option>
        </select>
    </div>

    <div class="mb-5">
        <label for="codigo_barras" class="block text-sm font-medium text-gray-700 mb-2">
            Código de Barras
        </label>

        <input
            type="number"
            name="codigo_barras"
            id="codigo_barras"
            class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-300 outline-none"
            placeholder="Digite o código de barras">
    </div>

    <div class="mb-5">
        <label for="nome" class="block text-sm font-medium text-gray-700 mb-2">
            Nome do Produto
        </label>

        <input
            type="text"
            name="nome"
            id="nome"
            class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-300 outline-none"
            placeholder="Digite o nome do produto">
    </div>

    <div class="mb-5">
        <label for="fabricante" class="block text-sm font-medium text-gray-700 mb-2">
            Fabricante
        </label>

        <input
            type="text"
            name="fabricante"
            id="fabricante"
            class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-300 outline-none"
            placeholder="Digite o fabricante">
    </div>

    <div class="mb-5">
        <label for="unidade_medida" class="block text-sm font-medium text-gray-700 mb-2">
            Unidade de Medida
        </label>

        <input
            type="text"
            name="unidade_medida"
            id="unidade_medida"
            class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-300 outline-none"
            placeholder="Ex.: Kg, Litro, Unidade">
    </div>

    <div class="mb-6">
        <label for="imagem" class="block text-sm font-medium text-gray-700 mb-2">
            Imagem
        </label>

        <input
            type="file"
            name="imagem"
            id="imagem"
            class="w-full rounded-lg border border-gray-300 px-3 py-2 file:bg-blue-600 file:text-white file:border-0 file:px-4 file:py-2 file:rounded-md file:cursor-pointer hover:file:bg-blue-700">
    </div>

    <div class="flex justify-end">
        <button
            type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg transition duration-300">
            Salvar Produto
        </button>
    </div>

</div>
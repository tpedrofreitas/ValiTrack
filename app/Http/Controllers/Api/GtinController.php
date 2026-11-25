<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GtinController extends Controller
{
    // Consulta um produto pelo código de barras na Open Food Facts
    public function show(string $codigo): JsonResponse
    {
        if (! preg_match('/^(\d{8}|\d{12,14})$/', $codigo)) {
            return response()->json(['message' => 'Código de barras inválido.'], 422);
        }

        $cacheKey = "gtin:off:{$codigo}";
        $naoEncontradoKey = "gtin:off:nf:{$codigo}";

        $emCache = Cache::get($cacheKey);
        if ($emCache) {
            return response()->json($emCache);
        }

        if (Cache::get($naoEncontradoKey)) {
            return response()->json(['message' => 'Produto não encontrado.'], 404);
        }

        $baseUrl = rtrim((string) config('services.openfoodfacts.url', 'https://world.openfoodfacts.org'), '/');
        $url = "{$baseUrl}/api/v2/product/{$codigo}";

        try {
            // A Open Food Facts não exige token, mas pede um User-Agent identificando o app
            $response = Http::withUserAgent('ValiTrack/1.0 (contato@seudominio.com)')
                ->acceptJson()
                ->timeout(10)
                ->get($url, [
                    'fields' => 'code,product_name,product_name_pt,generic_name,brands,categories,quantity,image_front_url,image_url',
                ]);
        } catch (\Throwable $e) {
            Log::warning('Open Food Facts indisponível: ' . $e->getMessage());

            return response()->json(['message' => 'Não foi possível consultar a Open Food Facts.'], 503);
        }

        if ($response->status() === 404) {
            Cache::put($naoEncontradoKey, true, now()->addHour());

            return response()->json(['message' => 'Produto não encontrado.'], 404);
        }

        if ($response->status() === 429) {
            return response()->json(['message' => 'Muitas consultas. Tente novamente em instantes.'], 429);
        }

        if (! $response->successful()) {
            Log::warning('Open Food Facts respondeu ' . $response->status() . ': ' . mb_substr($response->body(), 0, 500));

            return response()->json(['message' => 'A Open Food Facts não respondeu como esperado.'], 503);
        }

        $dados = $response->json();

        // status = 1 quando o produto existe, 0 quando não existe
        if ((int) data_get($dados, 'status', 0) !== 1) {
            Cache::put($naoEncontradoKey, true, now()->addHour());

            return response()->json(['message' => 'Produto não encontrado.'], 404);
        }

        $produto = data_get($dados, 'product', []);

        $nome = trim((string) (data_get($produto, 'product_name_pt')
            ?: data_get($produto, 'product_name')
            ?: data_get($produto, 'generic_name')
            ?: ''));

        if ($nome === '') {
            Cache::put($naoEncontradoKey, true, now()->addHour());

            return response()->json(['message' => 'Produto não encontrado.'], 404);
        }

        // "brands" vem como "Marca A, Marca B": usa a primeira
        $marcas = array_map('trim', explode(',', (string) data_get($produto, 'brands', '')));
        $fabricante = $marcas[0] ?? '';

        // "categories" vem do mais geral ao mais específico: usa a última
        $categorias = array_values(array_filter(array_map('trim', explode(',', (string) data_get($produto, 'categories', '')))));
        $categoria = $categorias ? preg_replace('/^[a-z]{2}:/i', '', end($categorias)) : '';

        $resultado = [
            'gtin'        => (string) data_get($produto, 'code', $codigo),
            'nome'        => $nome,
            'fabricante'  => $fabricante,
            'categoria'   => $categoria,
            'imagem'      => data_get($produto, 'image_front_url') ?: data_get($produto, 'image_url'),
            'quantidade'  => trim((string) data_get($produto, 'quantity', '')) ?: null,
            // Mantidos para o app continuar funcionando; a Open Food Facts não tem esses dados
            'ncm'         => null,
            'preco_medio' => null,
            'fonte'       => 'Open Food Facts',
        ];

        Cache::put($cacheKey, $resultado, now()->addDays(30));

        return response()->json($resultado);
    }
}

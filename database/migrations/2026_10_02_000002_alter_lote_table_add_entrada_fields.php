<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('lote', function (Blueprint $table) {
            $table->foreignId('fornecedor_id')
                ->nullable()
                ->after('produto_id')
                ->constrained('fornecedores');

            $table->decimal('valor_unitario', 10, 2)
                ->nullable()
                ->after('quantidade');

            $table->text('observacao')
                ->nullable()
                ->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lote', function (Blueprint $table) {
            $table->dropConstrainedForeignId('fornecedor_id');
            $table->dropColumn(['valor_unitario', 'observacao']);
        });
    }
};

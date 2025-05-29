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
        Schema::create('intens_vendas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cliente_id')->unsigned()->nullable(false);
            $table->bigInteger('vendas_id')->unsigned()->nullable(false);
            $table->integer('quantidade')->nullable(false);
            $table->decimal('valor',)->nullable(false);
            $table->decimal('valor_unit', )->nullable(false);
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->foreign('vendas_id')->references('id')->on('vendas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intens_vendas');
    }
};

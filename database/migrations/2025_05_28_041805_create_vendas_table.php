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
        Schema::create('vendas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cliente_id')->unsigned()->nullable(false);
            $table->bigInteger('produto_id')->unsigned()->nullable(false);
            $table->integer('quantidade')->nullable(false);
            $table->integer('parcelas')->nullable(true);
            $table->decimal('valor',)->nullable(false);
            $table->decimal('valor_unit',)->nullable(false);
            $table->date('data')->nullable(false);
            $table->foreign('produto_id')->references('id')->on('produtos');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendas');
    }
};

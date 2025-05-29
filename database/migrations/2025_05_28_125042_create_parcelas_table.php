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
        Schema::create('parcelas', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('venda_id')->unsigned()->nullable(false);
            $table->decimal('valor',)->nullable(false);
            $table->date('data_vencimento')->nullable(false);
            $table->integer('parcela')->nullable(true);
            $table->foreign('venda_id')->references('id')->on('vendas')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parcelas');
    }
};

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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 30);
            $table->string('sobrenome', 30)->nullable();
            $table->dateTime('data_nascimento')->nullable();
            $table->char('sexo', 1)->nullable();
            $table->float('altura', 3, 2)->nullable();
            $table->float('peso', 5, 2)->nullable();
            $table->string('cidade')->nullable();
            $table->string('endereco')->nullable();
            $table->string('rua')->nullable();
            $table->string('numero', 30)->nullable();
            $table->string('complemento')->nullable();
            $table->string('telefone1', 14)->nullable();
            $table->string('telefone2', 14)->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};

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
            $table->dateTime('data_nascimento');
            $table->char('sexo', 1);
            $table->float('altura', 3, 2);
            $table->float('peso', 5, 2);
            $table->string('cidade');
            $table->string('endereco');
            $table->string('rua');
            $table->string('numero', 30);
            $table->string('complemento');
            $table->string('telefone1', 14);
            $table->string('telefone2', 14);
            $table->string('email')->unique();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};

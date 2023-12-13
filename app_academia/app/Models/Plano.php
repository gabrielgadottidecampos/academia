<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plano extends Model
{
    use HasFactory;
    protected  $fillable  = [
        'nome',
        'descricao',
        'preco',
        'duracao'
    ];

    // função para definar as regras
    public function rules()
    {
        return ['nome' => 'required|min:3'];
    }
    // respostas 
    public function feedback()
    {
        return [
            'required' => 'Campo :attribute é obrigatório',
            'nome.min' => 'Nome deve ter no minimo 3 letras'
        ];
    }
}
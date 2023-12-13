<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    use HasFactory;
    protected  $fillable  = [
        'cliente_id',
        'academia_id',
        'plano_id',
        'situacao',
        'data_inicio_matricula',
        'data_fim_matricula'
    ];

    // função para definar as regras
    public function rules()
    {
        return [
            'cliente_id' => 'exists:clientes,id',
            'academia_id' => 'exists:academias,id',
            'plano_id' => 'exists:planos,id'
        ];
    }
    // respostas 
    public function feedback()
    {
        return [
            'required' => 'Campo :attribute é obrigatório',
            'exists' => 'Campo :attribute nao encontrado'
        ];
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
    public function academia()
    {
        return $this->belongsTo(Academia::class);
    }
    public function plano()
    {
        return $this->belongsTo(Plano::class);
    }
}
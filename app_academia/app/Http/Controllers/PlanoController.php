<?php

namespace App\Http\Controllers;

use App\Models\Plano;
use App\Http\Requests\StorePlanoRequest;
use App\Http\Requests\UpdatePlanoRequest;

class PlanoController extends Controller
{

    public function __construct(Plano $plano)
    {
        $this->plano = $plano;
    }

    public function index()
    {
        $plano = $this->plano->all();
        return $plano;
    }

    public function store(StorePlanoRequest $request)
    {
        $request->validate($this->plano->rules(), $this->plano->feedback());
        $plano = $this->plano->create([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'preco' => $request->preco,
            'duracao' => $request->duracao
        ]);
        return $plano;
    }

    public function show($id)
    {
        $plano = $this->plano->find($id);
        if ($plano === null) {
            return response()->json(['erro' => 'Recurso Não Encontrado'], 404);
        }
        return $plano;
    }

    public function update(UpdatePlanoRequest $request, $id)
    {
        $plano = $this->plano->find($id);
        if ($plano === null) {
            return response()->json(['erro' => 'Recurso Não Encontrado'], 404);
        }

        if ($request->method() === 'PATCH') {
            $regrasDinamicas = array();
            foreach ($plano->rules() as $input => $regra) {
                if (array_key_exists($input, $request->all())) {
                    $regrasDinamica[$input] = $regra;
                }
            }
            $request->validate($regrasDinamicas, $plano->feedback());
        } else {
            $request->validate($plano->rules(), $plano->feedback());
        }

        $plano->update([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'preco' => $request->preco,
            'duracao' => $request->duracao
        ]);
        return $plano;
    }

    public function destroy($id)
    {
        $plano = $this->plano->find($id);
        if ($plano === null) {
            return response()->json(['erro' => 'Não foi possivel excuir arquivo, o mesmo não existe'], 404);
        }
        $plano->delete();
    }
}
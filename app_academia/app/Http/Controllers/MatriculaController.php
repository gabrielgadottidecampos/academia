<?php

namespace App\Http\Controllers;

use App\Models\Matricula;
use App\Http\Requests\StoreMatriculaRequest;
use App\Http\Requests\UpdateMatriculaRequest;

class MatriculaController extends Controller
{
    public function __construct(Matricula $matricula)
    {
        $this->matricula = $matricula;
    }

    public function index()
    {
        $matricula = $this->matricula->all();
        return $matricula;
    }

    public function store(StoreMatriculaRequest $request)
    {
        $request->validate($this->matricula->rules());
        $matricula = $this->matricula->create([
            'cliente_id' => $request->cliente_id,
            'academia_id' => $request->academia_id,
            'plano_id' => $request->plano_id,
            'situacao' => $request->situacao,
            'data_inicio_matricula' => $request->data_inicio_matricula,
            'data_fim_matricula' => $request->data_fim_matricula
        ]);
        return $matricula;
    }

    public function show($id)
    {
        $matricula = $this->matricula->with('cliente', 'academia', 'plano')->find($id);
        if ($matricula === null) {
            return response()->json(['erro' => 'Recurso Não Encontrado'], 404);
        }
        return $matricula;
    }

    public function update(UpdateMatriculaRequest $request, $id)
    {
        $matricula = $this->matricula->find($id);
        if ($matricula === null) {
            return response()->json(['erro' => 'Recurso Não Encontrado'], 404);
        }

        if ($request->method() === 'PATCH') {
            $regrasDinamicas = array();
            foreach ($matricula->rules() as $input => $regra) {
                if (array_key_exists($input, $request->all())) {
                    $regrasDinamica[$input] = $regra;
                }
            }
            $request->validate($regrasDinamicas, $matricula->feedback());
        } else {
            $request->validate($matricula->rules(), $matricula->feedback());
        }

        $matricula->update([
            'cliente_id' => $request->cliente_id,
            'academia_id' => $request->academia_id,
            'plano_id' => $request->plano_id,
            'situacao' => $request->situacao,
            'data_inicio_matricula' => $request->data_inicio_matricula,
            'data_fim_matricula' => $request->data_fim_matricula
        ]);
        return $matricula;
    }
    public function destroy($id)
    {
        $matricula = $this->matricula->find($id);
        if ($matricula === null) {
            return response()->json(['erro' => 'Não foi possivel excuir arquivo, o mesmo não existe'], 404);
        }
        $matricula->delete();
    }
}
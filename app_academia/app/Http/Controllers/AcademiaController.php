<?php

namespace App\Http\Controllers;

use App\Models\Academia;
use App\Http\Requests\StoreAcademiaRequest;
use App\Http\Requests\UpdateAcademiaRequest;
use GuzzleHttp\Promise\Create;

class AcademiaController extends Controller
{
    public function __construct(Academia $academia)
    {
        $this->academia = $academia;
    }

    public function index()
    {
        $academia = $this->academia->all();
        return $academia;
    }

    public function store(StoreAcademiaRequest $request)
    {
        $request->validate($this->academia->rules(), $this->academia->feedback());
        $academia = $this->academia->create([
            'nome' => $request->nome,
            'endereco' => $request->endereco,
            'telefone1' => $request->telefone1,
            'telefone2' => $request->telefone2,
            'email' => $request->email
        ]);
        return $academia;
    }

    public function show($id)
    {
        $academia = $this->academia->find($id);
        if ($academia === null) {
            return response()->json(['erro' => 'Recurso Não Encontrado'], 404);
        }
        return $academia;
    }
    public function update(UpdateAcademiaRequest $request, $id)
    {

        $academia = $this->academia->find($id);
        if ($academia === null) {
            return response()->json(['erro' => 'Recurso Não Encontrado'], 404);
        }

        if ($request->method() === 'PATCH') {
            $regrasDinamicas = array();
            foreach ($academia->rules() as $input => $regra) {
                if (array_key_exists($input, $request->all())) {
                    $regrasDinamica[$input] = $regra;
                }
            }
            $request->validate($regrasDinamicas, $academia->feedback());
        } else {
            $request->validate($academia->rules(), $academia->feedback());
        }

        $academia->update([
            'nome' => $request->nome,
            'endereco' => $request->endereco,
            'telefone1' => $request->telefone1,
            'telefone2' => $request->telefone2,
            'email' => $request->email
        ]);
        return $academia;
    }
    public function destroy($id)
    {
        $academia = $this->academia->find($id);
        if ($academia === null) {
            return response()->json(['erro' => 'Não foi possivel excuir arquivo, o mesmo não existe'], 404);
        }
        $academia->delete();
    }
}
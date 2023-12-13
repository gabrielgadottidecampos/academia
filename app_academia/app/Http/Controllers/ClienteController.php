<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;

class ClienteController extends Controller
{
    public function __construct(Cliente $cliente)
    {
        $this->cliente = $cliente;
    }

    public function index()
    {
        $cliente = $this->cliente->all();
        return $cliente;
    }

    public function store(StoreClienteRequest $request)
    {
        $request->validate($this->cliente->rules(), $this->cliente->feedback());

        $cliente = $this->cliente->create([
            'nome' => $request->nome,
            'sobrenome' => $request->sobrenome,
            'data_nascimento' => $request->data_nascimento,
            'sexo' => $request->sexo,
            'altura' => $request->altura,
            'peso' => $request->peso,
            'cidade' => $request->cidade,
            'endereco' => $request->endereco,
            'rua' => $request->rua,
            'numero' => $request->numero,
            'complemento' => $request->complemento,
            'telefone1' => $request->telefone1,
            'telefone2' => $request->telefone2,
            'email' => $request->email
        ]);


        return $cliente;
    }


    public function show($id)
    {

        $cliente = $this->cliente->find($id);
        if ($cliente === null) {
            return response()->json(['erro' => 'Recurso Não Encontrado'], 404);
        }
        return $cliente;
    }


    public function update(UpdateClienteRequest $request, $id)
    {
        //return ['erro' => 'update'];
        $cliente = $this->cliente->find($id);

        if ($cliente === null) {
            return response()->json(['erro' => 'Não foi possivel atualizar o arquivo, o mesmo não existe'], 404);
        }

        if ($request->method() === 'PATCH') {
            $regrasDinamicas = array();
            foreach ($cliente->rules() as $input => $regra) {
                if (array_key_exists($input, $request->all())) {
                    $regrasDinamica[$input] = $regra;
                }
            }
            $request->validate($regrasDinamicas, $cliente->feedback());
        } else {
            $request->validate($cliente->rules(), $cliente->feedback());
        }


        $cliente->update([
            'nome' => $request->nome,
            'sobrenome' => $request->sobrenome,
            'data_nascimento' => $request->data_nascimento,
            'sexo' => $request->sexo,
            'altura' => $request->altura,
            'peso' => $request->peso,
            'cidade' => $request->cidade,
            'endereco' => $request->endereco,
            'rua' => $request->rua,
            'numero' => $request->numero,
            'complemento' => $request->complemento,
            'telefone1' => $request->telefone1,
            'telefone2' => $request->telefone2,
            'email' => $request->email
        ]);
        return $cliente;
    }

    public function destroy($id)
    {
        $cliente = $this->cliente->find($id);
        if ($cliente === null) {
            return response()->json(['erro' => 'Não foi possivel excuir arquivo, o mesmo não existe'], 404);
        }
        $cliente->delete();
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;

class ControllerCliente extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $clientes = Cliente::all();
        return view('clientes',compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $cli = null;
        return view('novocliente',compact('cli'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $regras = [
          'nome'=> 'required|min:2|max:100',
          'email' => 'required|unique:clientes|email',
          'idade' => 'required',
          'endereco' => 'required|min:5'
        ];
        $mensagens = [
          'required'=> 'O atributo :attribute não pode estar em branco',
          'nome.min' => 'É necessário no mínimo 3 caracteres no nome',
          'email.email'=>'Digite um endereço de email válido'
        ];
        // $request->validate{[
        //    'nome'=> 'required|min:2|max:100',
        //    'email' => 'required|unique:clientes|email',
        //    'idade' => 'required',
        //    'endereco' => 'required'
        //   ],$mensagens};
        $request->validate($regras,$mensagens);
        $cli = new Cliente();
        $cli->nome = $request->input('nome');
        $cli->email = $request->input('email');
        $cli->idade = $request->input('idade');
        $cli->endereco = $request->input('endereco');
        $cli->save();
        return redirect('/clientes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $cli = Cliente::find($id);

        if (isset($cli)) {
          return view('editarCliente', compact('cli'));
        }
         return redirect('/clientes');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $cli = Cliente::find($id);
        if(isset($id)){
          $cli->nome = $request->input('nome');
          $cli->idade = $request->input('idade');
          $cli->endereco = $request->input('endereco');
          $cli->email = $request->input('email');
          $cli->save();
        }
        return redirect('/clientes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $cli = Cliente::find($id);
        if(isset($cli)){
          $cli->delete();
        }
        return redirect('/clientes');
    }
}

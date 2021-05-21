<?php

namespace App\Http\Controllers;

use App\MotivoContato;
use App\SiteContato;
use Illuminate\Http\Request;

class ContatoController extends Controller
{
    public function contato(Request $request){

        $motivo_contatos = MotivoContato::all();

        return view('site.contato',['motivo_contatos' => $motivo_contatos]);
    }

    public function salvar(Request $request){

        $regras =   [
            'nome'=> 'required|min:3|max:40',
            'telefone'=> 'required',
            'email'=> 'email',
            'motivo_contatos_id'=> 'required',
            'mensagem'=> 'required|max:2000'
        ];

        $msg =  [
            'nome.min' => 'O campo nome precisa ter no mínimo 3 caracteres',
            'nome.max' => 'O campo nome precisa ter no máximo 40 caracteres',

            'motivo_contatos_id.required' => 'O campo motivo contato precisa ser selecionado',
            'email.email' => 'O email informado está inválido',

            'mensagem.max' => 'A mensagem deve ter no máximo 2000 caracteres',

            'required' => 'O campo :attribute precisa ser preenchido'
        ];

        $request->validate($regras, $msg);

        SiteContato::create($request->all());

        return redirect()->route('site.index');
    }
}

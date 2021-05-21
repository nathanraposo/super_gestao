<?php

namespace App\Http\Controllers;

use App\Fornecedor;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function index()
    {
        return view('app.fornecedor.index');
    }

    public function listar(Request $request)
    {
        $fornecedores = Fornecedor::with('produtos')->where('nome', 'like', '%' . $request->input('nome') . '%')
            ->where('site', 'like', '%' . $request->input('site') . '%')
            ->where('uf', 'like', '%' . $request->input('uf') . '%')
            ->where('email', 'like', '%' . $request->input('email') . '%')
            ->paginate(5);

        return view('app.fornecedor.listar', ['fornecedores' => $fornecedores, 'request' => $request->all()]);
    }

    public function adicionar(Request $request)
    {
        $msg = '';

        if ($request->input('_token') != '' && $request->input('id') == '') {
            $regras = [
                'nome' => 'required|min:3|max:40',
                'site' => 'required',
                'uf' => 'required|min:2|max:2',
                'email' => 'email'
            ];

            $msg = [
                'required' => 'O campo :attribute deve ser preenchido',
                'nome.min' => 'O campo nome deve ter no mínimo de 3 caracteres',
                'nome.max' => 'O campo nome deve ter no máximo de 40 caracteres',
                'uf.min' => 'O campo uf deve ter no mínimo de 3 caracteres',
                'uf.max' => 'O campo uf deve ter no máximo de 40 caracteres',
                'email' => 'O campo email não foi preenchido corretamente.'
            ];

            $request->validate($regras, $msg);

            Fornecedor::create($request->all());

            $msg = "Cadastro realizado com sucesso.";
        }

        //edição
        if ($request->input('_token') != '' && $request->input('id') != '') {
            $fornecedor = Fornecedor::find($request->input('id'));
            $fornecedor->update($request->all());

            if ($fornecedor->update($request->all())) {
                $msg = 'Atualização realizada com sucesso.';
            } else {
                $msg = 'Erro ao tentar atualizar o registro.';
            }

            return redirect()->route('app.fornecedor.editar', ['id' => $request->input('id'), 'msg' => $msg]);
        }

        return view('app.fornecedor.adicionar', ['msg' => $msg]);
    }

    public function editar(int $id, string $msg = '')
    {
        $fornecedor = Fornecedor::find($id);
        return view('app.fornecedor.adicionar', ['fornecedor' => $fornecedor, 'msg' => $msg]);
    }

    public function excluir(int $id)
    {
        Fornecedor::find($id)->delete();
        return redirect()->route('app.fornecedor');
    }
}

<?php

namespace App\Http\Controllers;

use App\Fornecedor;
use App\Produto;
use App\ProdutoDetalhe;
use App\Unidade;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $produtos = Produto::paginate(10);

//        foreach($produtos as  $key => $produto){
//            $produtoDetalhe = ProdutoDetalhe::where('produto_id',$produto->id)->first();
//
//            if(isset($produtoDetalhe)){
//                $produtos[$key]['comprimento'] = $produtoDetalhe->comprimento;
//                $produtos[$key]['altura'] = $produtoDetalhe->altura;
//                $produtos[$key]['largura'] = $produtoDetalhe->largura;
//            }
//        }

        return view('app.produto.index', ['produtos' => $produtos, 'request' => $request->all()]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $unidades = Unidade::all();
        $fornecedores = Fornecedor::all();
        return view('app.produto.create', ['unidades' => $unidades,'fornecedores' => $fornecedores]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $regras = [
            'nome' => 'required|min:3|max:40',
            'descricao' => 'required|min:3|max:200',
            'peso' => 'required|integer',
            'unidade_id' => 'exists:unidades,id',
            'fornecedor_id' => 'exists:fornecedores,id',
        ];

        $msg = [
            'required' => 'O campo :attribute deve ser preenchido',
            'nome.min' => 'O campo nome deve ter no mínimo de 3 caracteres',
            'nome.max' => 'O campo nome deve ter no máximo de 40 caracteres',
            'descricao.min' => 'O campo descrição deve ter no mínimo de 3 caracteres',
            'descricao.max' => 'O campo descrição deve ter no máximo de 2000 caracteres',
            'peso.integer' => 'O campo peso deve ser um número inteiro',
            'unidade_id.exists' => 'A unidade de medida informada não existe',
            'fornecedor_id.exists' => 'O fornecedor informado não existe'
        ];

        $request->validate($regras, $msg);

        Produto::create($request->all());

        return redirect()->route('produto.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Produto $produto
     * @return Application|Factory|View
     */
    public function show(Produto $produto)
    {
        return view('app.produto.show', ['produto' => $produto]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Produto $produto
     * @return Application|Factory|View
     */
    public function edit(Produto $produto)
    {
        $unidades = Unidade::all();
        $fornecedores = Fornecedor::all();
        return view('app.produto.edit', ['produto' => $produto, 'unidades' => $unidades, 'fornecedores' => $fornecedores]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Produto $produto
     * @return RedirectResponse
     */
    public function update(Request $request, Produto $produto)
    {
        $regras = [
            'nome' => 'required|min:3|max:40',
            'descricao' => 'required|min:3|max:200',
            'peso' => 'required|integer',
            'unidade_id' => 'exists:unidades,id',
            'fornecedor_id' => 'exists:fornecedores,id',
        ];

        $msg = [
            'required' => 'O campo :attribute deve ser preenchido',
            'nome.min' => 'O campo nome deve ter no mínimo de 3 caracteres',
            'nome.max' => 'O campo nome deve ter no máximo de 40 caracteres',
            'descricao.min' => 'O campo descrição deve ter no mínimo de 3 caracteres',
            'descricao.max' => 'O campo descrição deve ter no máximo de 2000 caracteres',
            'peso.integer' => 'O campo peso deve ser um número inteiro',
            'unidade_id.exists' => 'A unidade de medida informada não existe',
            'fornecedor_id.exists' => 'O fornecedor informado não existe'
        ];

        $request->validate($regras, $msg);

        $produto->update($request->all());

        return redirect()->route('produto.show', ['produto' => $produto->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Produto $produto
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Produto $produto)
    {
        $produto->delete();

        return redirect()->route('produto.index');
    }
}

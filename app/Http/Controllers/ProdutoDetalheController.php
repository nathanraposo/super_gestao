<?php

namespace App\Http\Controllers;

use App\ProdutoDetalhe;
use App\Unidade;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProdutoDetalheController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $unidades = Unidade::all();
        return view('app.produto_detalhe.create',['unidades' => $unidades]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ProdutoDetalhe::create($request->all());
        echo 'Deu bom carai';
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * @param ProdutoDetalhe $produtoDetalhe
     */
    public function edit(ProdutoDetalhe $produtoDetalhe)
    {
        $unidades = Unidade::all();
        return view('app.produto_detalhe.edit',['produto_detalhe' => $produtoDetalhe, 'unidades' => $unidades]);
    }

    /**
     * @param Request $request
     * @param ProdutoDetalhe $produtoDetalhe
     */
    public function update(Request $request, ProdutoDetalhe $produtoDetalhe)
    {
        $produtoDetalhe->update($request->all());
        echo 'Deu bom carai upou';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

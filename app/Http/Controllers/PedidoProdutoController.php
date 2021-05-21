<?php

namespace App\Http\Controllers;

use App\Pedido;
use App\PedidoProduto;
use App\Produto;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PedidoProdutoController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(Pedido $pedido)
    {
        $produtos = Produto::all();

        return view('app.pedido_produto.create', ['pedido' => $pedido, 'produtos' => $produtos]);
    }

    /**
     * @param Request $request
     * @param Pedido $pedido
     * @return RedirectResponse
     */
    public function store(Request $request, Pedido $pedido)
    {
        $regras = [
            'produto_id' => 'exists:produtos,id',
            'quantidade' => 'required',
        ];

        $msg = [
            'produto_id.exists' => 'O produto informado não existe',
            'required' => 'O campo :attribute deve receber um valor válido',
        ];

        $request->validate($regras, $msg);

//        $pedidoProduto = new PedidoProduto();
//        $pedidoProduto->pedido_id = $pedido->id;
//        $pedidoProduto->produto_id = $request->get('produto_id');
//        $pedidoProduto->quantidade = $request->get('quantidade');
//        $pedidoProduto->save();

        $pedido->produtos()->attach(
            $request->get('produto_id'),
            [
                'quantidade' => $request->get('quantidade')
            ]
        );

        return redirect()->route('pedido-produto.create',['pedido'=> $pedido->id]);
    }

    /**
     * @param PedidoProduto $pedidoProduto
     * @return RedirectResponse
     * @throws \Exception
     */
    //public function destroy(Pedido $pedido, Produto $produto)
    public function destroy(PedidoProduto $pedidoProduto)
    {

//        PedidoProduto::where([
//            'pedido_id' => $pedido->id,
//            'produto_id' => $produto->id
//        ])->delete();

//        $pedido->produtos()->detach($produto->id);

        $pedidoProduto->delete();
        return redirect()->route('pedido-produto.create',['pedido'=> $pedidoProduto->pedido_id]);

    }
}

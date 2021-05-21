<?php

use Illuminate\Support\Facades\Route;

//Rota Principal
Route::get('/', 'PrincipalController@principal')->name('site.index');

Route::get('/sobre-nos', 'SobreNosController@sobreNos')->name('site.sobrenos');
Route::get('/contato', 'ContatoController@contato')->name('site.contato');
Route::post('/contato', 'ContatoController@salvar')->name('site.contato');

Route::get('/login/{erro?}', 'LoginController@index')->name('site.login');
Route::post('/login', 'LoginController@autenticar')->name('site.login');

Route::prefix('app')->middleware( 'autenticacao')->group(function () {
    Route::get('/home', 'HomeController@index')->name('app.home');
    Route::get('/sair', 'LoginController@sair')->name('app.sair');

    Route::resource('produto', 'ProdutoController');
    Route::resource('produto-detalhe', 'ProdutoDetalheController');

    Route::resource('cliente', 'ClienteController');
    Route::resource('pedido', 'PedidoController');
//    Route::resource('peido-produto', 'PedidoProdutoController');

    Route::prefix('pedido-produto')->group(function (){
        Route::get('/create/{pedido}', 'PedidoProdutoController@create')->name('pedido-produto.create');
        Route::post('/store/{pedido}', 'PedidoProdutoController@store')->name('pedido-produto.store');
//        Route::delete('/destroy/{pedido}/{produto}', 'PedidoProdutoController@destroy')->name('pedido-produto.destroy');
        Route::delete('/destroy/{pedidoProduto}', 'PedidoProdutoController@destroy')->name('pedido-produto.destroy');
    });

    Route::prefix('fornecedor')->group(function (){
        Route::get('/', 'FornecedorController@index')->name('app.fornecedor');
        Route::post('/listar', 'FornecedorController@listar')->name('app.fornecedor.listar');
        Route::get('/listar', 'FornecedorController@listar')->name('app.fornecedor.listar');
        Route::get('/adicionar', 'FornecedorController@adicionar')->name('app.fornecedor.adicionar');
        Route::post('/adicionar', 'FornecedorController@adicionar')->name('app.fornecedor.adicionar');
        Route::get('/editar/{id}/{msg?}', 'FornecedorController@editar')->name('app.fornecedor.editar');
        Route::get('/excluir/{id}', 'FornecedorController@excluir')->name('app.fornecedor.excluir');
    });

});

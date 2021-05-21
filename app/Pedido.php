<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = ['cliente_id'];

    public function produtos()
    {
        //Relacionamento NÂO Padronizado do Framework LARAVEL
        return $this->belongsToMany(
            'App\Produto',
            'pedidos_produtos',
            'pedido_id',
            'produto_id'
        )->withPivot('created_at','quantidade','id');
        /*
        * 1 - MODELO do relacionamento NxN em relação ao Modelo que estamos implementando
        * 2 - È a tabela auxiliar que armazena os registros de relacionamento
        * 3 - Representa o nome da FK da tabela mapeada pelo modelo na tabela de relacionamento
        * 4 - Representa o nome da FK da tabela mapeada pelo model utilizado no relacionamento que estamos implementando
        */

        //Relacionamento Padronizado do Framework LARAVEL
        //return $this->belongsToMany('App\Produto','pedidos_produtos');
    }
}

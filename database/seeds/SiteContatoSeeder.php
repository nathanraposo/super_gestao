<?php

use App\SiteContato;
use Illuminate\Database\Seeder;

class SiteContatoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    //    $contato = new SiteContato();

    //    $contato->nome = 'Sistema SG';
    //    $contato->telefone = '(44) 99144-8554';
    //    $contato->email = 'contato@sg.com.br';
    //    $contato->motivo_contato = '1';
    //    $contato->mensagem = 'Seja bem-vindo ao sistema Super Gestão.';

    //    $contato->save();

        factory(SiteContato::class, 100)->create();
    }
}
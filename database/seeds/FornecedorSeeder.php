<?php

use App\Fornecedor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FornecedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fornecedor = new Fornecedor();

        $fornecedor->nome = 'Fornecedor 100';
        $fornecedor->site = 'fornecedor100.com.br';
        $fornecedor->uf = 'PR';
        $fornecedor->email = 'fornecedor@gmail.com';

        $fornecedor->save();

        Fornecedor::create([
            'nome' => 'Fornecedor 200',
            'site' => 'fornecedor200.com.br',
            'uf' => 'SP',
            'email' => 'fornecedor200@gmail.com',
        ]);

        DB::table('fornecedores')->insert([
            'nome' => 'Fornecedor 300',
            'site' => 'fornecedor300.com.br',
            'uf' => 'SC',
            'email' => 'fornecedor300@gmail.com',
        ]);

    }
}

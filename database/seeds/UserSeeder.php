<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Desenvolvedor',
            'email' => 'dev@listados.com.br',
            'password' => Hash::make('root'),
            'nick' => 'Dev',
            'id_profile' => 1,
            'status' => 1,
            'phone' => '(00) 00000-0000',
            'receive_proposal' => 1,
            'avatar' => null,
            'adm' => 1,
            'cpf' => '000.000.000-00',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

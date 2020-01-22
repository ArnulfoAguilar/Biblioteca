<?php

use Illuminate\Database\Seeder;

class EstanteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Estante')->insert([
            'id' => 1,
            'ID_BIBLIOTECA' => '1',
            'ESTANTE' => 'Estante numero uno',
            'CLASIFICACION' => '--',
        ]);
        
    }
}

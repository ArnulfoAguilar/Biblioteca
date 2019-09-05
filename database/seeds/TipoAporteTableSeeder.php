<?php

use Illuminate\Database\Seeder;

class TipoAporteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipoAporte')->insert([
            'TIPO_APORTE' => 'ESCRITO',
        ]);
        DB::table('tipoAporte')->insert([
            'TIPO_APORTE' => 'VIDEO',
        ]);
        DB::table('tipoAporte')->insert([
            'TIPO_APORTE' => 'PINTURA',
        ]);
    }
}

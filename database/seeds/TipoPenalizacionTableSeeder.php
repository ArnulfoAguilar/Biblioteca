<?php

use Illuminate\Database\Seeder;

class TipoPenalizacionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipoPenalizacion')->insert([
            'id' => 1,
            'TIPO_PENALIZACION' => 'Pagar el artículo dañado',
        ]);
        DB::table('tipoPenalizacion')->insert([
            'id' => 2,
            'TIPO_PENALIZACION' => 'Devolver algun artículo en representacion del perdido',
        ]);
        DB::table('tipoPenalizacion')->insert([
            'id' => 3,
            'TIPO_PENALIZACION' => 'Bloquear préstamos al usuario hasta que este se presente',
        ]);
        
    }
}

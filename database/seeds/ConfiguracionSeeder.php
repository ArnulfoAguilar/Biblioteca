<?php

use Illuminate\Database\Seeder;

class ConfiguracionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configuraciones')->insert([
            'DIAS_HABILES_PRORROGA' => 8,
            'DIAS_PRORROGABLES' => 5,
            'HABILITAR_COMENTARIOS' => True,
            'TAMAÑO_MAXIMO_ARCHIVOS'=>3000
        ]);
    }
}

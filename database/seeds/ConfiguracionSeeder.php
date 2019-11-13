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
            'TAMAÑO_MAXIMO_ARCHIVOS'=>3000,
            'NOMBRE_INSTITUCION'=>"Colegio Padre Arrupe",
            'DIRECCION_INSTITUCION'=>"Calle Padre Salazar Simpson, San Salvador"
        ]);
    }
}

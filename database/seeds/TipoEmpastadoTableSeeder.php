<?php

use Illuminate\Database\Seeder;

class TipoEmpastadoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipoEmpastado')->insert([
            'ID_TIPO_EMPASTADO' => 1,
            'NOMBRE' => 'Blanda',
        ]);
        DB::table('tipoEmpastado')->insert([
            'ID_TIPO_EMPASTADO' => 2,
            'NOMBRE' => 'Flexible',
        ]);
        DB::table('tipoEmpastado')->insert([
            'ID_TIPO_EMPASTADO' => 3,
            'NOMBRE' => 'Dura',
        ]);
        DB::table('tipoEmpastado')->insert([
            'ID_TIPO_EMPASTADO' => 4,
            'NOMBRE' => 'Cuero',
        ]);
    }
}

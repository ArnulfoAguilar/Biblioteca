<?php

use Illuminate\Database\Seeder;

class TipoAdquisicionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipoAdquisicion')->insert([
            'ID_TIPO_ADQUISICION' => 1,
            'NOMBRE' => 'Donación',
        ]);

        DB::table('tipoAdquisicion')->insert([
            'ID_TIPO_ADQUISICION' => 2,
            'NOMBRE' => 'Compra',
        ]);

        DB::table('tipoAdquisicion')->insert([
            'ID_TIPO_ADQUISICION' => 3,
            'NOMBRE' => 'Cambio',
        ]);

        DB::table('tipoAdquisicion')->insert([
            'ID_TIPO_ADQUISICION' => 4,
            'NOMBRE' => 'Préstamo',
        ]);

        DB::table('tipoAdquisicion')->insert([
            'ID_TIPO_ADQUISICION' => 5,
            'NOMBRE' => 'Interbibliotecario interno',
        ]);
        DB::table('tipoAdquisicion')->insert([
            'ID_TIPO_ADQUISICION' => 6,
            'NOMBRE' => 'Interbibliotecario externo',
        ]);
    }
}

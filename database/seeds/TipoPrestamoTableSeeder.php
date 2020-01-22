<?php

use Illuminate\Database\Seeder;

class TipoPrestamoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipoPrestamo')->insert([
            'id' => 1,
            'TIPO_PRESTAMO' => 'Préstamo individual',
        ]);
        DB::table('tipoPrestamo')->insert([
            'id' => 2,
            'TIPO_PRESTAMO' => 'Préstamo interbibliotecario interno',
        ]);
        DB::table('tipoPrestamo')->insert([
            'id' => 3,
            'TIPO_PRESTAMO' => 'Préstamo interbibliotecario externo',
        ]);
        DB::table('tipoPrestamo')->insert([
            'id' => 4,
            'TIPO_PRESTAMO' => 'Préstamo en sala',
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class EstadoPrestamoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estadoPrestamo')->insert([
            'id' => 1,
            'ESTADO_PRESTAMO' => 'Solicitado',
        ]);
        DB::table('estadoPrestamo')->insert([
            'id' => 2,
            'ESTADO_PRESTAMO' => 'Reservado',
        ]);
        DB::table('estadoPrestamo')->insert([
            'id' => 3,
            'ESTADO_PRESTAMO' => 'Prestado',
        ]);
        DB::table('estadoPrestamo')->insert([
            'id' => 4,
            'ESTADO_PRESTAMO' => 'Pendiente de Devolución',
        ]);
        DB::table('estadoPrestamo')->insert([
            'id' => 5,
            'ESTADO_PRESTAMO' => 'Finalizado',
        ]);
        DB::table('estadoPrestamo')->insert([
            'id' => 6,
            'ESTADO_PRESTAMO' => 'Prorrogado',
        ]);
        DB::table('estadoPrestamo')->insert([
            'id' => 7,
            'ESTADO_PRESTAMO' => 'Penalizado',
        ]);
    }
}

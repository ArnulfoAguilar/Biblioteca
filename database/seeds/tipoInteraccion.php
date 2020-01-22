<?php

use Illuminate\Database\Seeder;

class tipoInteraccion extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipoInteraccion')->insert([
            'NOMBRE' => 'LIKE',
        ]);
        DB::table('tipoInteraccion')->insert([
            'NOMBRE' => 'REPORT',
        ]);
    }
}

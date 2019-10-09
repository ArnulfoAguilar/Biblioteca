<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Comite')->insert([
            'COMITE' => 'MATEMATICAS',
            'ID_AREA' => '1',
        ]);
        DB::table('Comite')->insert([
            'COMITE' => 'LENGUAJE',
            'ID_AREA' => '2',
        ]);
        DB::table('Comite')->insert([
            'COMITE' => 'SOCIALES',
            'ID_AREA' => '3',
        ]);
        DB::table('Comite')->insert([
            'COMITE' => 'FISICA',
            'ID_AREA' => '4',
        ]);
    }
}

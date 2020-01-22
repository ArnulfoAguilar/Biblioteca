<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PalabraProhibidaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('palabraProhibida')->insert([
            'PALABRA' => 'puta',
        ]);
        DB::table('palabraProhibida')->insert([
            'PALABRA' => 'culero',
        ]);
        DB::table('palabraProhibida')->insert([
            'PALABRA' => 'cerote',
        ]);
        DB::table('palabraProhibida')->insert([
            'PALABRA' => 'marica',
        ]);
        DB::table('palabraProhibida')->insert([
            'PALABRA' => 'puto',
        ]);
        DB::table('palabraProhibida')->insert([
            'PALABRA' => 'mierda',
        ]);
    }
}

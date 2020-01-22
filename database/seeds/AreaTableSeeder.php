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
        DB::table('Area')->insert([
            'AREA' => 'MATEMATICAS',
        ]);
        DB::table('Area')->insert([
            'AREA' => 'LENGUA',
        ]);
        DB::table('Area')->insert([
            'AREA' => 'SOCIALES',
        ]);
        DB::table('Area')->insert([
            'AREA' => 'FISICA',
        ]);
    }
}

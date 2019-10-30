<?php

use Illuminate\Database\Seeder;

class SegundoSumarioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('segundoSumario')->insert([
            'id' => 1,
            'DESCRIPCION' => '110 - Metafísica',
            'ID_PRIMER_SUMARIO' => 2
        ]);
        DB::table('segundoSumario')->insert([
            'id' => 2,
            'DESCRIPCION' => '120 - Epistemología',
            'ID_PRIMER_SUMARIO' => 2
        ]);
        DB::table('segundoSumario')->insert([
            'id' => 3,
            'DESCRIPCION' => '150 - Psicología',
            'ID_PRIMER_SUMARIO' => 2
        ]);
        DB::table('segundoSumario')->insert([
            'id' => 4,
            'DESCRIPCION' => '220 - La Biblia',
            'ID_PRIMER_SUMARIO' => 3
        ]);
        DB::table('segundoSumario')->insert([
            'id' => 5,
            'DESCRIPCION' => '230 - Cristianismo; Teología Cristiana',
            'ID_PRIMER_SUMARIO' => 3
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class PrimerSumarioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('primerSumario')->insert([
            'id' => 1,
            'DESCRIPCION' => '000 - Generalidades',
        ]);
        DB::table('primerSumario')->insert([
            'id' => 2,
            'DESCRIPCION' => '100 - Filosofía y Psicología',
        ]);
        DB::table('primerSumario')->insert([
            'id' => 3,
            'DESCRIPCION' => '200 - Religión',
        ]);
        DB::table('primerSumario')->insert([
            'id' => 4,
            'DESCRIPCION' => '300 - Ciencias Sociales',
        ]);
    }
}

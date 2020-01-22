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
        DB::table('primerSumario')->insert(['id' => 1, 'DESCRIPCION' => '000 - Generalidades']);
        DB::table('primerSumario')->insert(['id' => 2, 'DESCRIPCION' => '100 - Filosofía y Psicología']);
        DB::table('primerSumario')->insert(['id' => 3, 'DESCRIPCION' => '200 - Religión']);
        DB::table('primerSumario')->insert(['id' => 4, 'DESCRIPCION' => '300 - Ciencias Sociales']);
        DB::table('primerSumario')->insert(['id' => 5, 'DESCRIPCION' => '400 - Lenguas']);
        DB::table('primerSumario')->insert(['id' => 6, 'DESCRIPCION' => '500 - Ciencias Naturales y Matemáticas']);
        DB::table('primerSumario')->insert(['id' => 7, 'DESCRIPCION' => '600 - Tecnologías (Ciencias Aplicadas)']);
        DB::table('primerSumario')->insert(['id' => 8, 'DESCRIPCION' => '700 - Las Artes']);
        DB::table('primerSumario')->insert(['id' => 9, 'DESCRIPCION' => '800 - Literatura y Retórica']);
        DB::table('primerSumario')->insert(['id' => 10, 'DESCRIPCION' => '900 - Geografía e Historia']);
    }
}

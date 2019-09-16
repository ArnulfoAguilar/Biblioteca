<?php

use Illuminate\Database\Seeder;

class PalabrasClaveTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('palabrasClave')->insert([
            'PALABRA' => 'Video',
        ]);
        DB::table('palabrasClave')->insert([
            'PALABRA' => 'Literatura',
        ]);
        DB::table('palabrasClave')->insert([
            'PALABRA' => 'Ambiente',
        ]);
        DB::table('palabrasClave')->insert([
            'PALABRA' => 'Conciencia',
        ]);
        DB::table('palabrasClave')->insert([
            'PALABRA' => 'Libertad',
        ]);
        DB::table('palabrasClave')->insert([
            'PALABRA' => 'Siguiente',
        ]);
        DB::table('palabrasClave')->insert([
            'PALABRA' => 'Vida',
        ]);
        DB::table('palabrasClave')->insert([
            'PALABRA' => 'Cielo',
        ]);

    }
}

<?php

use Illuminate\Database\Seeder;

class BibliotecaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Biblioteca')->insert([
            'id' => 1,
            'BIBLIOTECA' => 'Biblioteca numero uno',
            
        ]);
        
    }
}

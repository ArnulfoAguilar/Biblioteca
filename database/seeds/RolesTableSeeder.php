<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Rol')->insert([
            'ROL' => 'Administrador',
        ]);
        DB::table('Rol')->insert([
            'ROL' => 'Estudiante',
        ]);
        DB::table('Rol')->insert([
            'ROL' => 'Docente',
        ]);
        DB::table('Rol')->insert([
            'ROL' => 'Comité',
        ]);
    }
}

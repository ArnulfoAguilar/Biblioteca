<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('users')->insert(
            [
                'name' => 'Administrador',
                'email' => 'administrador@gmail.com',
                'password' => bcrypt('12345678'), // password
                'ID_ROL' => '1',
                'BIOGRAFIA' => 'Esta es mi pequeña biografia',
                'apellidos' => 'Quijano',
            ]
        );

        DB::table('users')->insert(
            [
                'name' => 'Administrador2',
                'email' => 'administrador2@gmail.com',
                'password' => bcrypt('12345678'), // password
                'ID_ROL' => '1',
                'BIOGRAFIA' => 'Esta es mi pequeña biografia',
                'apellidos' => 'Figueroa',
            ]
        );
        DB::table('users')->insert(
            [
                'name' => 'Estudiante',
                'email' => 'estudiante@gmail.com',
                'password' => bcrypt('12345678'),// password
                'ID_ROL' => '2',
                'BIOGRAFIA' => 'Esta es mi pequeña biografia',
                'apellidos' => 'Melara',
            ]
        );
        DB::table('users')->insert(
            [
                'name' => 'Estudiante2',
                'email' => 'estudiante2@gmail.com',
                'password' => bcrypt('12345678'),// password
                'ID_ROL' => '2',
                'BIOGRAFIA' => 'Esta es mi pequeña biografia',
                'apellidos' => 'Ortíz',
            ]
        );
        DB::table('users')->insert(
            [
                'name' => 'Docente',
                'email' => 'docente@gmail.com',
                'password' => bcrypt('12345678'), // password
                'ID_ROL' => '3',
                'BIOGRAFIA' => 'Esta es mi pequeña biografia',
                'apellidos' => 'Arteaga',


            ]
        );
        DB::table('users')->insert(
            [
                'name' => 'Docente2',
                'email' => 'docente2@gmail.com',
                'password' => bcrypt('12345678'), // password
                'ID_ROL' => '3',
                'BIOGRAFIA' => 'Esta es mi pequeña biografia',
                'apellidos' => 'Linares',

            ]
        );
        DB::table('users')->insert(
            [
                'name' => 'Departamento',
                'email' => 'departamento@gmail.com',
                'password' => bcrypt('12345678'), // password
                'ID_ROL' => '4',
                'BIOGRAFIA' => 'Esta es mi pequeña biografia',
                'apellidos' => 'Consuegra',
            ]
        );
        DB::table('users')->insert(
            [
                'name' => 'Departamento2',
                'email' => 'departamento2@gmail.com',
                'password' => bcrypt('12345678'), // password
                'ID_ROL' => '4',
                'BIOGRAFIA' => 'Esta es mi pequeña biografia',
                'apellidos' => 'Maléfica',
            ]
        );
    }
}

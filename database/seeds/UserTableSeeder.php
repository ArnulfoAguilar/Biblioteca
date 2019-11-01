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
            ]
        );

        DB::table('users')->insert(
            [
                'name' => 'Administrador2',
                'email' => 'administrador2@gmail.com',
                'password' => bcrypt('12345678'), // password
                'ID_ROL' => '1',
            ]
        );
        DB::table('users')->insert(
            [
                'name' => 'Estudiante',
                'email' => 'estudiante@gmail.com',
                'password' => bcrypt('12345678'),// password
                'ID_ROL' => '2',
            ]
        );
        DB::table('users')->insert(
            [
                'name' => 'Estudiante2',
                'email' => 'estudiante2@gmail.com',
                'password' => bcrypt('12345678'),// password
                'ID_ROL' => '2',
            ]
        );
        DB::table('users')->insert(
            [
                'name' => 'Docente',
                'email' => 'docente@gmail.com',
                'password' => bcrypt('12345678'), // password
                'ID_ROL' => '3',

            ]
        );
        DB::table('users')->insert(
            [
                'name' => 'Docente2',
                'email' => 'docente2@gmail.com',
                'password' => bcrypt('12345678'), // password
                'ID_ROL' => '3',

            ]
        );
        DB::table('users')->insert(
            [
                'name' => 'Comite',
                'email' => 'comite@gmail.com',
                'password' => bcrypt('12345678'), // password
                'ID_ROL' => '4',
            ]
        );
        DB::table('users')->insert(
            [
                'name' => 'Comite2',
                'email' => 'comite2@gmail.com',
                'password' => bcrypt('12345678'), // password
                'ID_ROL' => '4',
            ]
        );
    }
}

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
                'name' => 'luis',
                'email' => 'luis@keeper.com',
                'password' => bcrypt('12345678') // password
            ],
            [
                'name' => 'stephanie',
                'email' => 'stephanie@gmail.com',
                'password' => bcrypt('12345678')
            ]
        );
        DB::table('users')->insert(
            [
                'name' => 'kevin',
                'email' => 'kevin@gmail.com',
                'password' => bcrypt('12345678') // password
            ]
        );
    }
}

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
            ]
        );
        DB::table('users')->insert(
            [
                'name' => 'stephanie',
                'email' => 'stephanie@gmail.com',
                'password' => bcrypt('12345678')
            ]
        );
    }
}

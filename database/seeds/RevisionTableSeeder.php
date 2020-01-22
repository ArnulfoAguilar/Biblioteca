<?php

use Illuminate\Database\Seeder;

class RevisionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estadoRevision')->insert([
            'id' => 1,
            'ESTADO_REVISION' => 'Solventada',
        ]);
        DB::table('estadoRevision')->insert([
            'id' => 2,
            'ESTADO_REVISION' => 'Pendiente',
        ]);
    }
}

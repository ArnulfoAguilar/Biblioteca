<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        
        $this->call(UserTableSeeder::class);
        $this->call(RevisionTableSeeder::class);
        $this->call(AreaTableSeeder::class);
        $this->call(TipoAporteTableSeeder::class);
        $this->call(PalabrasClaveTableSeeder::class);
        $this->call(tipoInteraccion::class);
        $this->call(ComiteTableSeeder::class);
        $this->call(PalabraProhibidaTableSeeder::class);
        $this->call(ConfiguracionSeeder::class);

    }
}

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
        $this->call(UserTableSeeder::class);
        $this->call(RevisionTableSeeder::class);
        $this->call(AreaTableSeeder::class);
        $this->call(TipoAporteTableSeeder::class);
        $this->call(PalabrasClaveTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(PrimerSumarioTableSeeder::class);
        $this->call(SegundoSumarioTableSeeder::class);
        $this->call(TercerSumarioTableSeeder::class);
        $this->call(TipoAdquisicionTableSeeder::class);
        $this->call(TipoAporteTableSeeder::class);
        $this->call(TipoEmpastadoTableSeeder::class);
        $this->call(CatalogoMaterialTableSeeder::class);
        $this->call(EstadoEjemplarTableSeeder::class);
        $this->call(EstadoPrestamoTableSeeder::class);
        $this->call(TipoPrestamoTableSeeder::class);
    }
}

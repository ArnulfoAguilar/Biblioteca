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
        $this->call(PalabrasClaveTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(RevisionTableSeeder::class);
        $this->call(AreaTableSeeder::class);
        $this->call(PalabrasClaveTableSeeder::class);
        $this->call(TipoPenalizacionTableSeeder::class);
        $this->call(tipoInteraccion::class);
        $this->call(ComiteTableSeeder::class);
        $this->call(PalabraProhibidaTableSeeder::class);
        $this->call(ConfiguracionSeeder::class);
        $this->call(PrimerSumarioTableSeeder::class);
        $this->call(SegundoSumarioTableSeeder::class);
        $this->call(TercerSumarioTableSeeder::class);
        $this->call(PuntuacionesSeeder::class);
        $this->call(Niveles::class);
        $this->call(TipoAdquisicionTableSeeder::class);
        $this->call(TipoAporteTableSeeder::class);
        $this->call(TipoEmpastadoTableSeeder::class);
        $this->call(CatalogoMaterialTableSeeder::class);
        $this->call(EstadoEjemplarTableSeeder::class);
        $this->call(EstadoPrestamoTableSeeder::class);
        $this->call(TipoPrestamoTableSeeder::class);
        $this->call(PermisosTableSeeder::class);
        $this->call(RolPermisoTableSeeder::class);

    }
}

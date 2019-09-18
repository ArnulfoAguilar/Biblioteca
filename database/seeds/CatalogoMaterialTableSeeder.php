<?php

use Illuminate\Database\Seeder;

class CatalogoMaterialTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('catalogoMaterial')->insert([
            'id' => 1,
            'NOMBRE' => 'Libro',
            'DESCRIPCION' => 'Libro que ingresa al inventario de la biblioteca',
        ]);
        DB::table('catalogoMaterial')->insert([
            'id' => 2,
            'NOMBRE' => 'Revista',
            'DESCRIPCION' => 'Revista que ingresa al inventario de la biblioteca',
        ]);
        DB::table('catalogoMaterial')->insert([
            'id' => 1,
            'NOMBRE' => 'Archivo Multimedia',
            'DESCRIPCION' => 'Archivo multimedia que ingresa al inventario de la biblioteca',
        ]);
    }
}

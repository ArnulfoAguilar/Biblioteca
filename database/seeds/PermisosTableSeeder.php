<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class PermisosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permisos')->insert([
            'id' => 1,
            'correlativo' => 1,
            'nombre_corto' => 'pres-add',
            'nombre' => 'Realizar Prestamo',
            'descripcion' => 'Muestra lo necesario para realizar un prestamo',
        ]);
        DB::table('permisos')->insert([
            'id' => 2,
            'correlativo' => 2,
            'nombre_corto' => 'manag-pres',
            'nombre' => 'Gestionar Prestamos',
            'descripcion' => 'Muestra lo necesario para gestionar los prestamos',
        ]);
        DB::table('permisos')->insert([
            'id' => 3,
            'correlativo' => 3,
            'nombre_corto' => 'pres-mine',
            'nombre' => 'Mis Prestamos',
            'descripcion' => 'Muestra los prestamos realizados por el usuario',
        ]);
        DB::table('permisos')->insert([
            'id' => 4,
            'correlativo' => 4,
            'nombre_corto' => 'penaltys',
            'nombre' => 'Penalizaciones',
            'descripcion' => 'Muestra las penalizaciones registradas',
        ]);
        DB::table('permisos')->insert([
            'id' => 5,
            'correlativo' => 5,
            'nombre_corto' => 'solvency',
            'nombre' => 'Extender Solvencia',
            'descripcion' => 'Muestra lo necesario extender solvencias',
        ]);
        DB::table('permisos')->insert([
            'id' => 6,
            'correlativo' => 6,
            'nombre_corto' => 'manag-bib',
            'nombre' => 'Gestionar Bibliotecas',
            'descripcion' => 'Muestra lo necesario para Gestionar Bibliotecas',
        ]);
        DB::table('permisos')->insert([
            'id' => 7,
            'correlativo' => 7,
            'nombre_corto' => 'manag-est',
            'nombre' => 'Gestionar Estantes',
            'descripcion' => 'Muestra lo necesario para gestionar los estantes',
        ]);
        DB::table('permisos')->insert([
            'id' => 8,
            'correlativo' => 8,
            'nombre_corto' => 'manag-books',
            'nombre' => 'Gestionar Ejemplares',
            'descripcion' => 'Muestra lo necesario para gestionar los ejemplares',
        ]);
        DB::table('permisos')->insert([
            'id' => 9,
            'correlativo' => 9,
            'nombre_corto' => 'bar-code',
            'nombre' => 'Codigos de barra',
            'descripcion' => 'Muestra lo necesario para generar codigos de barra de los ejemplares',
        ]);
        DB::table('permisos')->insert([
            'id' => 10,
            'correlativo' => 10,
            'nombre_corto' => 'aportes',
            'nombre' => 'Aportes de la comunidad',
            'descripcion' => 'Muestra los aportes aprobados en el sistema',
        ]);
        DB::table('permisos')->insert([
            'id' => 11,
            'correlativo' => 11,
            'nombre_corto' => 'aportes-mine-check',
            'nombre' => 'Mis aportes aprobados',
            'descripcion' => 'Muestra los aportes aprobados del usuario ',
        ]);
        DB::table('permisos')->insert([
            'id' => 12,
            'correlativo' => 12,
            'nombre_corto' => 'aportes-mine',
            'nombre' => 'Mis aportes pendientes',
            'descripcion' => 'Muestra los aportes sin aprobar del usuario',
        ]);
        DB::table('permisos')->insert([
            'id' => 13,
            'correlativo' => 13,
            'nombre_corto' => 'aportes-all',
            'nombre' => 'Todos los aportes',
            'descripcion' => 'Muestra todos los aportes en el sistema',
        ]);
        DB::table('permisos')->insert([
            'id' => 14,
            'correlativo' => 14,
            'nombre_corto' => 'aportes-area',
            'nombre' => 'Aportes del area',
            'descripcion' => 'Muestra todos los aportes del area asignada al usuario',
        ]);
        DB::table('permisos')->insert([
            'id' => 15,
            'correlativo' => 15,
            'nombre_corto' => 'adqui',
            'nombre' => 'Ver sugerencias de adquisicion',
            'descripcion' => 'Muestra las sugerencias de adquisicion',
        ]);
        DB::table('permisos')->insert([
            'id' => 16,
            'correlativo' => 16,
            'nombre_corto' => 'adqui-add',
            'nombre' => 'crear sugerencia de adquisicion',
            'descripcion' => 'Muestra lo necesario para realizar una sugerencia de adquisicion',
        ]);
        DB::table('permisos')->insert([
            'id' => 17,
            'correlativo' => 17,
            'nombre_corto' => 'link-rol',
            'nombre' => 'Asignar rol',
            'descripcion' => 'Muestra lo necesario para asignar un rol a un usuario',
        ]);
        DB::table('permisos')->insert([
            'id' => 18,
            'correlativo' => 18,
            'nombre_corto' => 'link-dep',
            'nombre' => 'Asignar departamento',
            'descripcion' => 'Muestra lo necesario para asignar departamento a un usuario',
        ]);
        DB::table('permisos')->insert([
            'id' => 19,
            'correlativo' => 19,
            'nombre_corto' => 'calendario',
            'nombre' => 'Calendario',
            'descripcion' => 'Muestra el calendario para asignar dias no habiles',
        ]);
        DB::table('permisos')->insert([
            'id' => 20,
            'correlativo' => 20,
            'nombre_corto' => 'points',
            'nombre' => 'Puntajes de usuarios',
            'descripcion' => 'Muestra los puntajes de los usuarios en el sistema',
        ]);
        DB::table('permisos')->insert([
            'id' => 21,
            'correlativo' => 21,
            'nombre_corto' => 'manag-role',
            'nombre' => 'Gestion de roles',
            'descripcion' => 'Muestra lo necesario para gestionar roles',
        ]);
        DB::table('permisos')->insert([
            'id' => 22,
            'correlativo' => 22,
            'nombre_corto' => 'manag-dep',
            'nombre' => 'Gestionar departamentos',
            'descripcion' => 'Muestra lo necesario para gestionar departamentos',
        ]);
        DB::table('permisos')->insert([
            'id' => 23,
            'correlativo' => 23,
            'nombre_corto' => 'manag-words',
            'nombre' => 'Gestionar palabras prohibidas',
            'descripcion' => 'Muestra lo necesario para gestionar las palabras prohibidas',
        ]);
        DB::table('permisos')->insert([
            'id' => 24,
            'correlativo' => 24,
            'nombre_corto' => 'type-penalty',
            'nombre' => 'Gestionar tipos de penalizaciones',
            'descripcion' => 'Muestra lo necesario para gestionar tipos de penalizaciones',
        ]);
        DB::table('permisos')->insert([
            'id' => 25,
            'correlativo' => 25,
            'nombre_corto' => 'config',
            'nombre' => 'Configuraciones',
            'descripcion' => 'Muestra las configuraciones parametrizables del sistema',
        ]);
        DB::table('permisos')->insert([
            'id' => 26,
            'correlativo' => 26,
            'nombre_corto' => 'log',
            'nombre' => 'Registro de actividad',
            'descripcion' => 'Muestra el registro de actividad en el sistema',
        ]);
        DB::table('permisos')->insert([
            'id' => 27,
            'correlativo' => 27,
            'nombre_corto' => 'per-area',
            'nombre' => 'Grafico de aportes por area',
            'descripcion' => 'Muestra el Grafico de aportes por area',
        ]);
        DB::table('permisos')->insert([
            'id' => 28,
            'correlativo' => 28,
            'nombre_corto' => 'per-year',
            'nombre' => 'Grafico de aportes por año',
            'descripcion' => 'Muestra el Grafico de aportes por area',
        ]);
        DB::table('permisos')->insert([
            'id' => 29,
            'correlativo' => 29,
            'nombre_corto' => 'stats',
            'nombre' => 'Estadisticas',
            'descripcion' => 'Muestra las estadisticas en la pantalla principal',
        ]);
        
        
    }
}

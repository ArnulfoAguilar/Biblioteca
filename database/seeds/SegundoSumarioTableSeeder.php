<?php

use Illuminate\Database\Seeder;

class SegundoSumarioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('segundoSumario')->insert(['id' => 1, 'DESCRIPCION' => '010 - Bibliografía', 'ID_PRIMER_SUMARIO' => 1 ]);
        DB::table('segundoSumario')->insert(['id' => 2, 'DESCRIPCION' => '020 - Bibliotecología y ciencias de la información', 'ID_PRIMER_SUMARIO' => 1 ]);
        DB::table('segundoSumario')->insert(['id' => 3, 'DESCRIPCION' => '030 - Obras enciclopédicas generales', 'ID_PRIMER_SUMARIO' => 1 ]);
        DB::table('segundoSumario')->insert(['id' => 4, 'DESCRIPCION' => '040 - ', 'ID_PRIMER_SUMARIO' => 1 ]);
        DB::table('segundoSumario')->insert(['id' => 5, 'DESCRIPCION' => '050 - Publicaciones en series generales', 'ID_PRIMER_SUMARIO' => 1 ]);
        DB::table('segundoSumario')->insert(['id' => 6, 'DESCRIPCION' => '060 - Oganizaciones generales & museología', 'ID_PRIMER_SUMARIO' => 1 ]);
        DB::table('segundoSumario')->insert(['id' => 7, 'DESCRIPCION' => '070 - Medios noticiosos, periodismo, publicación', 'ID_PRIMER_SUMARIO' => 1 ]);
        DB::table('segundoSumario')->insert(['id' => 8, 'DESCRIPCION' => '080 - Colecciones generales', 'ID_PRIMER_SUMARIO' => 1 ]);
        DB::table('segundoSumario')->insert(['id' => 9, 'DESCRIPCION' => '090 - Manuscritos & libros raros', 'ID_PRIMER_SUMARIO' => 1 ]);
        DB::table('segundoSumario')->insert(['id' => 10, 'DESCRIPCION' => '110 - Metafísica', 'ID_PRIMER_SUMARIO' => 2 ]);
        DB::table('segundoSumario')->insert(['id' => 11, 'DESCRIPCION' => '120 - Epistemología  causalidad, género humano',  'ID_PRIMER_SUMARIO' => 2 ]);
        DB::table('segundoSumario')->insert(['id' => 12, 'DESCRIPCION' => '130 - Fenómenos paranormales',  'ID_PRIMER_SUMARIO' => 2 ]);
        DB::table('segundoSumario')->insert(['id' => 13, 'DESCRIPCION' => '140 - Escuelas filosóficas específicas',  'ID_PRIMER_SUMARIO' => 2 ]);
        DB::table('segundoSumario')->insert(['id' => 14, 'DESCRIPCION' => '150 - Psicología', 'ID_PRIMER_SUMARIO' => 2 ]);
        DB::table('segundoSumario')->insert(['id' => 15, 'DESCRIPCION' => '160 - Lógica', 'ID_PRIMER_SUMARIO' => 2 ]);
        DB::table('segundoSumario')->insert(['id' => 16, 'DESCRIPCION' => '170 - Ética (filosofía moral)', 'ID_PRIMER_SUMARIO' => 2 ]);
        DB::table('segundoSumario')->insert(['id' => 17, 'DESCRIPCION' => '180 - Filosofía antigua, medieval, oriental', 'ID_PRIMER_SUMARIO' => 2 ]);
        DB::table('segundoSumario')->insert(['id' => 18, 'DESCRIPCION' => '190 - Filosofía moderna occidental', 'ID_PRIMER_SUMARIO' => 2 ]);
        DB::table('segundoSumario')->insert(['id' => 19, 'DESCRIPCION' => '210 - Filosofía  y teología de la relig.',  'ID_PRIMER_SUMARIO' => 3 ]);
        DB::table('segundoSumario')->insert(['id' => 20, 'DESCRIPCION' => '220 - La Biblia',  'ID_PRIMER_SUMARIO' => 3 ]);
        DB::table('segundoSumario')->insert(['id' => 21, 'DESCRIPCION' => '230 - Cristianismo; Teología Cristiana', 'ID_PRIMER_SUMARIO' => 3 ]);
        DB::table('segundoSumario')->insert(['id' => 22, 'DESCRIPCION' => '240 - La Biblia',  'ID_PRIMER_SUMARIO' => 3 ]);
        DB::table('segundoSumario')->insert(['id' => 23, 'DESCRIPCION' => '250 - La Biblia',  'ID_PRIMER_SUMARIO' => 3 ]);
        DB::table('segundoSumario')->insert(['id' => 24, 'DESCRIPCION' => '260 - La Biblia',  'ID_PRIMER_SUMARIO' => 3 ]);
        DB::table('segundoSumario')->insert(['id' => 25, 'DESCRIPCION' => '270 - La Biblia',  'ID_PRIMER_SUMARIO' => 3 ]);
        DB::table('segundoSumario')->insert(['id' => 26, 'DESCRIPCION' => '280 - La Biblia',  'ID_PRIMER_SUMARIO' => 3 ]);
        DB::table('segundoSumario')->insert(['id' => 27, 'DESCRIPCION' => '290 - La Biblia',  'ID_PRIMER_SUMARIO' => 3 ]);
        DB::table('segundoSumario')->insert(['id' => 28, 'DESCRIPCION' => '310 - La Biblia',  'ID_PRIMER_SUMARIO' => 3 ]);


    }
}

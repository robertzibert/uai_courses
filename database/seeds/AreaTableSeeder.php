<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class AreaTableSeeder extends Seeder {

    public function run()
    {
      $areas = [
                  ['name' => 'TI', 'complete_name' => 'Informática'],
                  ['name' => 'TALLER', 'complete_name' => 'Taller'],
                  ['name' => 'OPERACIONES', 'complete_name' => 'Operaciones'],
                  ['name' => 'OOCC', 'complete_name' => 'Oocc'],
                  ['name' => 'MIN', 'complete_name' => 'Minería'],
                  ['name' => 'MAT', 'complete_name' => 'Matemática'],
                  ['name' => 'LAB', 'complete_name' => 'Laboratorio'],
                  ['name' => 'ING', 'complete_name' => 'Ingeniería'],
                  ['name' => 'FIS', 'complete_name' => 'Física'],
                  ['name' => 'EYM', 'complete_name' => 'Eym'],
                  ['name' => 'EST', 'complete_name' => 'Estadística'],
                  ['name' => 'BIO', 'complete_name' => 'Bioingeniería'],
                  ['name' => '5TO AÑO', 'complete_name' => 'Quinto Año'],
                ];

        foreach ($areas as $area) {
              App\Area::create([
                'name'          => $area['name'],
                'complete_name' => $area['complete_name'],
                ]);
        }
      }

}

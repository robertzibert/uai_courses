<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;


use App\Role;
use Faker\Factory as Faker;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $roles = [
        'Administrador',
        'Coordinador TI',
        'Coordinador TALLER',
        'Coordinador OPERACIONES',
        'Coordinador OOCC',
        'Coordinador MIN',
        'Coordinador MAT',
        'Coordinador LAB',
        'Coordinador ING',
        'Coordinador FIS',
        'Coordinador EYM',
        'Coordinador EST',
        'Coordinador BIO',
        'Coordinador 5TO AÑO',
      ];

      foreach ($roles as $role) {
        Role::create([
              'name' => $role,
        ]);
      }

    }
}

<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Role;
use Faker\Factory as Faker;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = User::create([

            'name'     => "Administrador",
            'email'    => "admin@cursos.com",
            'password' => Hash::make("123456"),
            'role_id' => 1,
        ]);

          $user = User::create([
            'name'     => "Barbara Jugo",
            'email'    => "barbara.jugo@uai.cl",
            'password' => Hash::make("123456"),
            'role_id' => 1,
            ]);

        $user = User::create([
            'name'     => "Germán Garretón",
            'email'    => "ggarreton@alumnos.uai.cl",
            'password' => Hash::make("123456"),
            'role_id' => 1,
            ]);

    }
}

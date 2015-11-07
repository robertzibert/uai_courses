<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class AreaTableSeeder extends Seeder {

    public function run()
    {
      factory('App\Area', 3)->create();
    }

}

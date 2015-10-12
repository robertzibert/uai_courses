<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfessorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('professors', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
						$table->string('type');
						$table->string('rut');
						$table->decimal('annual_load', 2);
						$table->decimal('min_load', 2);
						$table->decimal('max_load', 2);
            $table->timestamps();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('professors');
	}

}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('courses', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
						$table->string('code');
						$table->string('section');
						$table->integer('semester');
						$table->string('branch');
						$table->decimal('load', 2);
						$table->string('schedule');
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
		Schema::drop('courses');
	}

}

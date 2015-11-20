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
						$table->integer('professor_id')->unsigned()->nullable();
						$table->integer('area_id')->unsigned()->nullable();
						$table->string('name');
						$table->string('code');
						$table->string('section');
						$table->string('semester');
						$table->string('branch');
						$table->integer('year');
						$table->string('schedule');
						$table->double('load',5, 2);
						$table->timestamps();

						$table->foreign('professor_id')
						 ->references('id')
						 ->on('professors');

						$table->foreign('area_id')
							->references('id')
							->on('areas');

        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('courses', function (Blueprint $table) {
				 $table->dropForeign(['professor_id']);
				 $table->dropColumn('professor_id');
			 });

		Schema::drop('courses');
	}

}

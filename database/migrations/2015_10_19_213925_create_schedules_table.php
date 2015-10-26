<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
   	{

      Schema::create('schedules', function(Blueprint $table) {
              $table->increments('id');
   						$table->integer('course_id')->unsigned();
   						$table->string('schedule');
   						$table->timestamps();

   						$table->foreign('course_id')
   						 ->references('id')
   						 ->on('courses');
             });
   	}

   	/**
   	 * Reverse the migrations.
   	 *
   	 * @return void
   	 */
   	public function down()
   	{
   		Schema::table('schedules', function (Blueprint $table) {
   				 $table->dropForeign(['course_id']);
   				 $table->dropColumn('course_id');
   			 });

   		Schema::drop('schedules');
   	}
}

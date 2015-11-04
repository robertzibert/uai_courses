<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherAreaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professorsAreas', function(Blueprint $table) {
            $table->increments('id');
            $table->string('area');
            $table->timestamps();
            $table->integer('professor_id')->unsigned();

            $table->foreign('professor_id')
                  ->references('id')
                  ->on('professors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('professorsAreas');
    }
}

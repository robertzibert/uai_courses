<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreaProfessorPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('area_professor', function (Blueprint $table) {
            $table->integer('area_id')->unsigned()->index();
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');
            $table->integer('professor_id')->unsigned()->index();
            $table->foreign('professor_id')->references('id')->on('professors')->onDelete('cascade');
            $table->primary(['area_id', 'professor_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('area_professor');
    }
}

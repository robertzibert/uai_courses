<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTeacherIdToShedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('schedules', function (Blueprint $table) {
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
        Schema::table('schedules', function (Blueprint $table) {
                 $table->dropForeign(['professor_id']);
                 $table->dropColumn('professor_id');
        });
    }
}

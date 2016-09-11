<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExercisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         *
         *
         * updated 2016/08/16 exer_comm is now text not medtext
         */
        Schema::create('exercises', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('workout_id')->unsigned();
            $table->foreign('workout_id')->references('id')->on('workouts');
            $table->text('exer_type');
            $table->tinyInteger('order')->unsigned()->nullable();
            $table->tinyInteger('sets')->unsigned();
            $table->tinyInteger('reps')->unsigned()->nullable();
            $table->integer('start_weight')->unsigned()->nullable();
            $table->text('exer_comm')->nullable();
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
        Schema::drop('exercises');
    }
}

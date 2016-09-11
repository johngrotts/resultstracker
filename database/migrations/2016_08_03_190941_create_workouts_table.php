<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * Creates the workouts table
         * client ties to the userid of the client
         * trainer ties to the useris of the trainer
         * iscomplete is for registering if the client finished the wo
         * comments for each person, trainer before, client after wo is complete
         * timestamps for record keeping
         */
        Schema::create('workouts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('users');
            $table->integer('trainer_id')->unsigned();
            $table->foreign('trainer_id')->references('id')->on('users');
            $table->boolean('is_complete')->default(false);
            $table->mediumText('trainer_comm')->nullable();
            $table->text('client_comm')->nullable();
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
        Schema::drop('workouts');
    }
}

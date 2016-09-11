<?php

namespace App;
use App\User;
use App\Exercise;
use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
	protected $fillable = ['client_id', 'trainer_id', 'trainer_comm', 'client_comm'];  // allows array assigning
	
    // returns the exercises for this workout
    public function exercises() {
    	return $this->hasMany(Exercise::class);
    }

    // adds an exercise to the selected workout
    public function addExercise(Exercise $exercise) {
    	return $this->exercise()->save($exercise);
    }

    // gets the client information 
    public function client() {
        return $this->hasOne('App\User', 'id', 'client_id');
    }

    // gets the trainer information
    public function trainer() {
        return $this->hasOne('App\User', 'id', 'trainer_id');
    }
    
}

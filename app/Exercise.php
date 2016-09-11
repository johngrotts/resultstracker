<?php

namespace App;
use App\Workout;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
	protected $fillable = ['workout_id', 'exer_type', 'order', 'sets', 'reps', 'start_weight', 'exer_comm']; // allows array assigning

    // calls the workout this exercise belongs to
    public function workout() {
    	return $this->belongsTo(Workout::class);
    }

    
}

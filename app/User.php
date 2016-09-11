<?php

namespace App;
use App\Exercise;
use App\Workout;
use App\Role;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use RolesTraits;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'is_active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // gets the workouts to teh users
    public function workouts() {
        return $this->hasMany('App\Workout');
    }
    
    // gets the full name of the user
    public function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}



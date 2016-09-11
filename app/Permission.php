<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    // specific activities "Create Workout", "Edit User Roles"

	// what permissions associate with this role?
    public function roles() {
    	return $this->belongsToMany(Role::class);
    }
}

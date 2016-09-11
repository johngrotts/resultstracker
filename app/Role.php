<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    // This is the Object for giving a user the position "Trainer", "Admin", etc.

	// what roles can do this action (permission)?
    public function permissions() {
    	return $this->belongsToMany(Permission::class);
    }

    // join the roles and permissions together (this role gives permission to ____)
    public function givePermissionTo(Permission $permission) {
    	return $this->permissions()->save();
    }

}

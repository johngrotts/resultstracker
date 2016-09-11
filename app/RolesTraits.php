<?php

namespace App;

trait RolesTraits {
    // which roles does the user have?
    public function roles() {
        return $this->belongsToMany(Role::class);
    }

    // returns the first (highest rank) role of the user
    public function getHighestRole() {
        return $this->roles->first();
    }

    // gives the user a certain role
    public function assignRole($role) {
        return $this->roles()->attach(
            Role::whereName($role)->firstOrFail()
        );
    }

    // remove the role from the user
    public function detachRole($role) {
        return $this->roles()->detach(
            Role::whereName($role)->firstOrFail()
        );
    }

    // checks the roles of a user
    public function hasRole($role) {
        // allows for a string
        if (is_string($role)) {
            return $this->roles->contains('name', $role); // is the string found in the name column of the roles table?
        }
        //or a collection (aka check all of the users roles and see if they match up.)
        return !! $role->intersect($this->roles)->count();
    }

    // function for adjusting role
    public function saveRole($role) { // Role::class or Role $role or $role ?
        if ($this->hasRole($role)) {
            return $this->detachRole($role);
        }
        else {
            return $this->assignRole($role);
        }
    }

}
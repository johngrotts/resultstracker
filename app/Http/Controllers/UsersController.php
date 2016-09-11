<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests;

class UsersController extends Controller
{
    // primary
    public function index() {
        if (Auth::user()->cannot('view_users')) {
            return abort(403); //Deny Permissions
        }
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // show an individual user
    public function show(User $user) {
        if (Auth::user()->cannot('view_users')) {
            return abort(403); //Deny Permissions
        }
        return view('users.show', compact('user'));
    }

    // edits a user
    public function edit(User $user) {
        if (Auth::user()->cannot('edit_users')) {
            return abort(403); //Deny Permissions
        }
        $isActive = $user->is_active; // checks to see if the user is active in the system
        $roles = Role::all(); // sends all of the possible roles
        return view('users.edit', compact('user', 'isActive', 'roles'));
    }

    // updates the user information
    public function update(Request $request, User $user) {
        // checks to see if the Auth user can edit this user
        if ($request->user()->cannot('edit_users')) {
            return abort(403); //Deny Permissions
        }
        // checks and validates the inputs
        $this->validate($request, [
            'is_active' => 'required',
        ]);
        $user->update($request->all());
        return back();
    }

    // assigns roles
    public function updateRole(User $user, Role $role) {
        $user->saveRole($role->name);
        return back();
    }
}

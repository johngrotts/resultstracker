<?php

namespace App\Http\Controllers;

use App\User;
use App\Permission;
use Illuminate\Http\Request;

use App\Http\Requests;

class RolesController extends Controller
{
    // primary
    public function index() {
    	return view('index');
    }

}

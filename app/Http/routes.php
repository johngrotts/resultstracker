<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
| Route::group(['middleware' => ['web'], function () {
*/

Route::auth();

Route::group(['middlewareGroup' => 'web'], function () {

	// Home Controller
	Route::get('/', 'HomeController@index');
	Route::get('/profile', 'HomeController@profile');
	
	// Workouts
	// Route::resource('workouts', 'WorkoutsController'); //set for all regular controllers, does not work	
	Route::get('/workouts', 'WorkoutsController@index'); // primary
	Route::get('/workouts/create', 'WorkoutsController@create'); // form for creating a new workout
	Route::get('/workouts/history', 'WorkoutsController@history'); // view all past workouts TODO
	Route::get('/workouts/trainer', 'WorkoutsController@trainer'); // view all workouts assigned by the trainer TODO
	Route::get('/workouts/{workout}', 'WorkoutsController@show'); // shows individual workout
	Route::post('/workouts', 'WorkoutsController@store'); // actual storing of new workout
	Route::get('/workouts/{workout}/edit', 'WorkoutsController@edit'); // form for editing a workout
	Route::patch('/workouts/{workout}', 'WorkoutsController@update'); // updates the edited workout
	Route::patch('/workouts/{workout}/complete', 'WorkoutsController@complete'); // Completes the workout
	Route::delete('/workouts/{workout}', 'WorkoutsController@destroy'); // deletes the workout

	// Exercise
	Route::get('/exercises', 'ExercisesController@index'); // primary
	Route::get('/exercises/create', 'ExercisesController@create'); //form for adding 1 exercise
	Route::get('/exercises/{workout}/addexercise', 'ExercisesController@addexercise'); //form for adding 1 exercise to a specific workout
	Route::get('/exercises/{exercise}/edit', 'ExercisesController@edit'); // form for editting an exercise
	Route::patch('/exercises/{exercise}', 'ExercisesController@update'); // updates the workout
	Route::get('/exercises/{workout}', 'ExercisesController@show'); //gets exercises for the specific workout.
	Route::post('/exercises', 'ExercisesController@storeExercise'); //stores the crested exercise

	// Users
	Route::get('/users', 'UsersController@index'); // primary
	Route::get('/users/profile', 'UsersController@profile'); // user profile page
	Route::get('/users/{user}', 'UsersController@show'); // shows individual user
	Route::get('/users/{user}/edit', 'UsersController@edit'); // form for editing the user
	Route::patch('/users/{user}', 'UsersController@update'); // updates the workout
	Route::patch('/users/{user}/role/{role}', 'UsersController@updateRole');

	// Roles
	Route::get('/roles', 'RolesController@index'); // primary
	Route::get('/roles/users/{user}', 'RolesController@editUserRole'); // edits the roles for a user
	Route::patch('/roles/users/{user}', 'RolesController@updateUserRole'); // updates the user role

});


//Other





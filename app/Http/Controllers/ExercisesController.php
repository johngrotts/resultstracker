<?php

namespace App\Http\Controllers;
use App\Workout;
use App\Exercise;
use App\User;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests;

class ExercisesController extends Controller
{
    /**
     * Create a new controller instance.
     * Requires authentification on this workouts controllers
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    // primary
    public function index() {
    	return view('/home');
    }

    // shows individual exercises
    public function show(Exercise $exercise) {
    	return view('exercise.show', compact('exercise'));
    }

    // show the form for creating a new exercise
    public function create() {
        $workouts = Workout::all(); // sends workouts for client selection
        return view('exercises.create', compact('workouts'));
    }

    // show the form for creating a new exercise FOR A SPECIFIC WORKOUT
    public function addexercise(Workout $workout) {
        return view('exercises.addexercise', compact('workout'));
    }

    // shows the form for editing an exercise
    public function edit(Exercise $exercise) {
        // trainer who created it or manager and higher can edit the workout
        if ($exercise->workout->trainer_id != Auth::id() || Auth::user()->cannot('edit_workout')) {
            //return 'not your exercise'; // TODO: ERROR PAGE FOR not your workout 
            return abort(403); //Deny Permissions
        }
        $workout = Workout::where('id', $exercise->workout_id)->get();
        return view('exercises.edit', compact('exercise', 'workout'));

    }

    // makes a new exercise
    public function storeExercise(Request $request) {
        // you have to be allowed to make exercises
        if (Auth::user()->cannot('create_exercise')) {
            return abort(403); //Deny Permissions
        }
        // checks and validates the inputs
        $this->validate($request, [
            'workout_id' => 'required',
            'exer_type' => 'required',
            'sets' => 'required'
        ]);
        $workout = Workout::where('id', $request->workout_id)->firstOrFail();
        // you have to be a manager or the workout trainer
        if ($workout->trainer_id != Auth::id() || Auth::user()->cannot('edit_exercise')) {
            //return 'not your workout'; // TODO: ERROR PAGE FOR not your workout
            return abort(403); //Deny Permissions
        }
        $exercisesForWo = Exercise::where('workout_id', $request->workout_id)->count();
        $order = $exercisesForWo + 1;

        Exercise::create([
            'workout_id' => $request['workout_id'],
            'exer_type' => $request['exer_type'],
            'order' => $order,
            'sets' => $request['sets'],
            'reps' => $request['reps'],
            'start_weight' => $request['start_weight'],
            'exer_comm' => $request['exer_comm'],
        ]);
    	return view('workouts.updatesuccess', compact('workout'));
    }

    // updates the exercise
    public function update(Request $request, Exercise $exercise) {
        // checks to see if the user can make a workout
        if ($request->user()->cannot('edit_exercise')) {
            return abort(403); //Deny Permissions
        }
        // checks and validates the inputs
        $this->validate($request, [
            'exer_type' => 'required',
            'sets' => 'required'
        ]);
        $exercise->update($request->all());
        $workout = Workout::where('id', $exercise->workout_id)->firstOrFail();
        return view('workouts.updatesuccess', compact('workout'));
    }

}

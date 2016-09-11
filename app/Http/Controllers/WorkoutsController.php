<?php

namespace App\Http\Controllers;
use App\Workout;
use App\Exercise;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;


//use App\Http\Requests; //possible remove?

class WorkoutsController extends Controller
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
    public function index(User $user) {
        // loads all incomplete workouts assigned to the user ordered from oldest to newest
        $workouts = Workout::where('client_id', Auth::id())->where('is_complete', 'FALSE')->orderBy('id', 'asc')->get();
    	return view('workouts.index', compact('workouts'));
    }

    // history
    public function history(User $user) {
        $workouts = Workout::where('client_id', Auth::id())->orderBy('id', 'des')->get();
        return view('workouts.history', compact('workouts'));
    }

    // history page for the trainer. Shows active and inactive workouts
    public function trainer() {
        $newWorkouts = Workout::where('trainer_id', Auth::id())->where('is_complete', 0)->orderBy('id', 'des')->get();
        $carbon = Carbon::now(); 
        $carbon = $carbon->subDays(8);
        $completeWorkouts = Workout::where('trainer_id', Auth::id())->where('is_complete', 1)->whereDate('updated_at', '>=', $carbon)->orderBy('id', 'des')->get();
        return view('workouts.trainer', compact('newWorkouts', 'completeWorkouts'));
    }
    
    // returns the specific workout with exercises
    public function show(Workout $workout) {
        // the owner of the workout OR a manager can see it.
        if ($workout->client_id != Auth::id() && !Auth::user()->hasRole('manager')) {
            return abort(403); 
        }
        // sends users for client selection
        $users = User::all();
        return view('workouts.show', compact('workout', 'users'));
    }

    // shows the form for editing the workout
    public function edit(Workout $workout) {
        // trainer who created it or manager and higher can edit the workout
        if ($workout->trainer_id != Auth::id() || !Auth::user()->hasRole('manager')) {
            return abort(403); //Deny Permissions
        }
        // checks to see if the workout is completed already
        if ($workout->is_complete == 1) {
            //return 'workout is complete'; // TODO: ERROR PAGE FOR workout complete
            return abort(403); //Deny Permissions
        }
        // sends users for client selection
        $users = User::all();
        return view('workouts.edit', compact('workout', 'users'));
    }

    // show the form for creating a new workout
    public function create() {
        if (Auth::user()->cannot('create_workout')) {
            return abort(403); //Deny Permissions
        }
        $users = User::where('is_active', '1')->orderBy('last_name', 'asc')->get();
    	// $users = User::all(); // sends users for client selection
    	return view('workouts.create', compact('users'));
    }

    // makes a new workout
    public function store(Request $request) {
        // checks to see if the user can make a workout
        if ($request->user()->cannot('create_workout')) {
            return abort(403); //Deny Permissions
        }
    	// checks and validates the inputs
    	$this->validate($request, [
    		'client_id' => 'required',
    		'trainer_comm' => 'required'
    	]);

        // Validates the exercises, skipping all that have no activity.
        $validator = Validator::make($request->all(), [
            'exercises.*.exer_type' => ['required'],
            'exercises.*.sets' => 'required:integer',
        ]);
        // kills the submission if things aren't filled out correctly.
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $exercises = $request->exercises;

    	// creates the workout
    	$newWorkout = Workout::create([
            'trainer_comm' => $request['trainer_comm'],
            'client_id' => $request['client_id'],
            'trainer_id' => $request->user()->id,
        ]);

        $workoutId = $newWorkout->id;
        $i = 1;
        foreach ($exercises as $exercise) {
            Exercise::create([
            'workout_id' => $workoutId,
            'exer_type' => $exercise['exer_type'],
            'order' => $i,
            'sets' => $exercise['sets'],
            'reps' => $exercise['reps'],
            'start_weight' => $exercise['start_weight'],
            'exer_comm' => $exercise['exer_comm'],
            ]);
            $i++;
        }

    	return view('workouts.workoutsaved', compact('newWorkout'));
    }

    // updates the workout
    public function update(Request $request, Workout $workout) {
        // checks to see if the user can make a workout
        if ($request->user()->cannot('edit_workout') || $workout->trainer_id != Auth::id()) {
            return abort(403); //Deny Permissions
        }
        // checks and validates the inputs
        $this->validate($request, [
            'client_id' => 'required',
            'trainer_comm' => 'required'
        ]);
        $workout->update($request->all());
        return view('workouts.updatesuccess', compact('workout'));
    }

    // completes the workout
    public function complete(Request $request, Workout $workout) {
        // checks to see if the user owns the workout
        if ($request->user()->id != Auth::id()) {
            return abort(403); //Deny Permissions
        }
        $workout->client_comm = $request->client_comm;
        $workout->is_complete = 1;
        $workout->save();
        return view('workouts.complete');
    }

}

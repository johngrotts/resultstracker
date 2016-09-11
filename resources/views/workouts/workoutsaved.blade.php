@extends('../layouts.app')
<!-- workouts show file -->
@section('content')
	<h1>Workout Saved</h1> 
	<div class="table-responsive container-fluid">
		<table class="table table-condensed">
			<thead>
				<tr>
					<th>
						Trainer:
					</th>
					<th>
						Client:
					</th>
					<th>
						Date Assigned:
					</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						{{ $newWorkout->trainer->getFullName() }}
					</td>
					<td>
						{{ $newWorkout->client->getFullName() }}
					</td>
					<td>
						{{ $newWorkout->created_at->format('m/d/Y') }}
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="table-responsive container-fluid">
		<table class="table table-striped table-condensed">
			<thead>
				<tr>
					<th class="col-md-1">Order</th>
					<th class="col-md-3">Activity</th>
					<th class="col-md-1">Sets</th>
					<th class="col-md-1">Reps</th>
					<th class="col-md-2">Starting Weight</th>
					@if($newWorkout->trainer_id == Auth::id() || Auth::user()->hasRole('manager'))
						<th class="col-md-3">Notes</th>
						<th class="col-md-1"></th>
					@else
						<th class="col-md-4">Notes</th>
					@endif
				</tr>
			</thead>
			<tbody>
			@foreach ($newWorkout->exercises as $exercise)
				<tr>
					<td>{{ $exercise->order }}</td>
					<td>{{ $exercise->exer_type }}</td>
					<td>{{ $exercise->sets }}</td>
					<td>{{ $exercise->reps }}</td>
					<td>{{ $exercise->start_weight }}</td>
					<td>{{ $exercise->exer_comm }}</td>
					@if($newWorkout->trainer_id == Auth::id() || Auth::user()->hasRole('manager'))
						<td><a href="/exercises/{{ $exercise->id }}/edit" class="btn btn-default btn-xs">Edit This Exercise</a></td>
					@endif
				</tr>
			@endforeach
			</tbody>
		</table>
		<table class="table table-condensed">
			<thead>
				<tr>
					<th>
						Workout Notes:
					</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						{{ $newWorkout->trainer_comm }}
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	System Workout id: {{ $newWorkout->id }}
	<hr>
	@if(($newWorkout->trainer_id == Auth::id() || Auth::user()->hasRole('manager')) && $newWorkout->is_complete == 0)
	<p class="text-right">TRAINER PERMISSIONS:
	<a href="/workouts/{{ $newWorkout->id }}/edit" class="btn btn-info">Edit This Workout</a>
	<a href="/exercises/{{ $newWorkout->id }}/addexercise" class="btn btn-info">Add an Exercise</a>
	@endif

@endsection
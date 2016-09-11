@extends('../layouts.app')
<!-- workouts show file -->
@section('content')
	<h1>Your Workout</h1> 
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
					@if ($workout->is_complete == 1)
					<th>
						Workout Complete on:
					</th> 
					@endif
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						{{ $workout->trainer->getFullName() }}
					</td>
					<td>
						{{ $workout->client->getFullName() }}
					</td>
					<td>
						{{ $workout->created_at->format('m/d/Y') }}
					</td>
					@if ($workout->is_complete == 1)
					<td>
						{{ $workout->updated_at->format('m/d/Y') }}
					</td> 
					@endif
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
					@if($workout->trainer_id == Auth::id() || Auth::user()->hasRole('manager'))
						<th class="col-md-3">Notes</th>
						<th class="col-md-1"></th>
					@else
						<th class="col-md-4">Notes</th>
					@endif
				</tr>
			</thead>
			<tbody>
			@foreach ($workout->exercises as $exercise)
				<tr>
					<td>{{ $exercise->order }}</td>
					<td>{{ $exercise->exer_type }}</td>
					<td>{{ $exercise->sets }}</td>
					<td>{{ $exercise->reps }}</td>
					<td>{{ $exercise->start_weight }}</td>
					<td>{{ $exercise->exer_comm }}</td>
					@if($workout->trainer_id == Auth::id() || Auth::user()->hasRole('manager'))
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
						{{ $workout->trainer_comm }}
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	@if (Auth::id() == $workout->client_id && $workout->is_complete == 0)
		<hr>
		<h2>Complete Your Workout</h2>
		<form method="POST" action="/workouts/{{ $workout->id }}/complete">
		{{ method_field('PATCH') }} {{-- allows PATCH request on older browsers --}}
		{{ csrf_field() }} {{-- token that protects the form --}}
			<div class="form-group">
			How do you feel about this workout? 
				<textarea name="client_comm" class="form-control">{{ old('client_comm') }}</textarea>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary">Complete Your Workout</button>
			</div>
		<!-- displays errors -->
		@if (count($errors))
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		@endif
		</form>
	@endif
	System Workout id: {{ $workout->id }}
	<hr>
	@if(($workout->trainer_id == Auth::id() || Auth::user()->hasRole('manager')) && $workout->is_complete == 0)
	<p class="text-right">TRAINER PERMISSIONS:
	<a href="/workouts/{{ $workout->id }}/edit" class="btn btn-info">Edit This Workout</a>
	<a href="/exercises/{{ $workout->id }}/addexercise" class="btn btn-info">Add an Exercise</a>
	@endif

@endsection
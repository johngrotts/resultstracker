@extends('../layouts.app')
<!-- workouts history TRAINER file -->
@section('content')
	<h1>New Workouts </h1>
	<div class="table-responsive container-fluid">
		<table class="table table-striped table-condensed">
			<thead>
				<tr>
					<th class="col-md-2">Workout Date</th>
					<th class="col-md-7">Your Comments</th>
					<th class="col-md-2">Client Name</th>
					<th class="col-md-1"></th>
				</tr>
			</thead>
			<tbody>
			@foreach ($newWorkouts as $workout)
				<tr>
					<td>{{ $workout->created_at->format('m/d/Y') }}</td>
					<td>{{ $workout->trainer_comm }}</td>
					<td>{{ $workout->client->getFullName() }}</td>
					<td><a href="/workouts/{{ $workout->id }}" class="btn btn-default btn-xs">View This Workout</a></td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
	<h1>Completed Workouts (last 8 days)</h1>
	<div class="table-responsive container-fluid">
		<table class="table table-striped table-condensed">
			<thead>
				<tr>
					<th class="col-md-1">Workout Date</th>
					<th class="col-md-2">Your Comments</th>
					<th class="col-md-2">Client Name</th>
					<th class="col-md-5">Client Comments</th>
					<th class="col-md-1">Completed Date</th>
					<th class="col-md-1"></th>
				</tr>
			</thead>
			<tbody>
			@foreach ($completeWorkouts as $workout)
				<tr>
					<td>{{ $workout->created_at->format('m/d/Y') }}</td>
					<td>{{ $workout->trainer_comm }}</td>
					<td>{{ $workout->client->getFullName() }}</td>
					<td>{{ $workout->client_comm }}</td>
					<td>{{ $workout->updated_at->format('m/d/Y') }}</td>
					<td><a href="/workouts/{{ $workout->id }}" class="btn btn-default btn-xs">View This Workout</a></td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
	
@endsection
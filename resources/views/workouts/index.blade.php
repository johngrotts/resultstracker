@extends('../layouts.app')
<!-- workouts index file -->
@section('content')
	<h1> Workouts </h1>
	<div class="table-responsive container-fluid">
		<table class="table table-striped table-condensed">
			<thead>
				<tr>
					<th class="col-md-2">Workout Date</th>
					<th class="col-md-4">Trainer Comments</th>
					<th class="col-md-1"></th>
				</tr>
			</thead>
			<tbody>
			@foreach ($workouts as $workout)
				<tr>
					<td>{{ $workout->created_at->format('m/d/Y') }}</td>
					<td>{{ $workout->trainer_comm }}</td>
					<td><a href="/workouts/{{ $workout->id }}" class="btn btn-default btn-xs">View This Workout</a></td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
	
@endsection
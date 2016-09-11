@extends('../layouts.app')
<!-- workouts edit file -->
@section('content')
	<h1>Workout</h1>	
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

	<h2>Edit the Workout</h2>
	<form method="POST" action="/workouts/{{ $workout->id }}">
	{{ method_field('PATCH') }} {{-- allows PATCH request on older browsers --}}
	{{ csrf_field() }} {{-- token that protects the form --}}
		<div class="form-group">
			Client: 
			<select class="form-control" name="client_id">
			<option value=''></option>
			@foreach ($users as $user)
				<option value="{{ $user->id }}" {{ (Request::old("client_id", $workout->client_id) == $user->id ? "selected":"") }}>{{ $user->first_name }} {{ $user->last_name }}</option>
			@endforeach
			</select>
		</div>
		<div class="form-group">
		Trainer Comments: 
			<textarea name="trainer_comm" class="form-control">{{ old('trainer_comm', $workout->trainer_comm) }}</textarea>
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-primary">Update Workout</button>
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

@endsection
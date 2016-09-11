@extends('../layouts.app')
<!-- exercises create file -->
@section('content')
	<h1> Create an Exercise</h1>

	<form method="POST" action="/exercises" class="form-vertical">
	{{ csrf_field() }} {{-- token that protects the form --}}
		<div class="form-group">
    	<h3>Attach to This Workout:</h3>
		{{ $workout->id }} - {{ $workout->client->last_name }}, {{ $workout->client->first_name }} - {{ $workout->created_at->format('F d, Y') }}
		</div>
		<div class="form-group">
    		<label for="exer_type">What Activity?*</label> 
			<textarea name="exer_type" class="form-control" placeholder="What Activity?">{{ old('exer_type') }}</textarea>
		</div>
		<div class="form-group">
    		<label for="sets">Sets*</label> 
			<input type="number" name="sets" class="form-control" min="0" value="{{ old('sets') }}"  placeholder="Sets">
		</div>
		<div class="form-group">
		<label for="reps">Reps</label> 
			<input type="number" name="reps" class="form-control" min="0" value="{{ old('reps') }}"  placeholder="Reps">
		</div>
		<div class="form-group">
		<label for="start_weight">Starting Weight</label> 
			<input type="number" name="start_weight" class="form-control" min="0" value="{{ old('start_weight') }}"  placeholder="Start Weight">
		</div>
		<div class="form-group">
		<label for="exer_comm">Trainer Notes</label>   
			<textarea name="exer_comm" class="form-control"  placeholder="Trainer Notes">{{ old('exer_comm') }}</textarea>
		</div>
		<div class="form-group"><input type="hidden" name="workout_id" value="{{ $workout->id }}">
			<button type="submit" class="btn btn-primary">Add Exercise</button>
		</div>
		<div class="form-group">
		* Indicates Required
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
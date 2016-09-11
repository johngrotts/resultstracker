@extends('../layouts.app')
<!-- exercises edit file -->
@section('content')
	<h1> Edit This Exercise</h1>

	<form method="POST" action="/exercises/{{ $exercise->id }}" class="form-vertical">
	{{ method_field('PATCH') }} {{-- allows PATCH request on older browsers --}}
	{{ csrf_field() }} {{-- token that protects the form --}}
		<div class="form-group">
    		{{ $exercise->workout->id }} - {{ $exercise->workout->client->last_name }}, {{ $exercise->workout->client->first_name }} - {{ $exercise->workout->created_at->format('F d, Y') }}
		</div>
		<div class="form-group">
    		<label for="exer_type">What Activity?*</label> 
			<textarea name="exer_type" class="form-control" placeholder="What Activity?">{{ old('exer_type', $exercise->exer_type) }}</textarea>
		</div>
		<div class="form-group">
    		<label for="sets">Sets*</label> 
			<input type="number" name="sets" class="form-control" min="0" value="{{ old('sets', $exercise->sets) }}"  placeholder="Sets">
		</div>
		<div class="form-group">
		<label for="reps">Reps</label> 
			<input type="number" name="reps" class="form-control" min="0" value="{{ old('reps', $exercise->reps) }}"  placeholder="Reps">
		</div>
		<div class="form-group">
		<label for="start_weight">Starting Weight</label> 
			<input type="number" name="start_weight" class="form-control" min="0" value="{{ old('start_weight', $exercise->start_weight) }}"  placeholder="Start Weight">
		</div>
		<div class="form-group">
		<label for="exer_comm">Trainer Notes</label>   
			<textarea name="exer_comm" class="form-control"  placeholder="Trainer Notes">{{ old('exer_comm', $exercise->exer_comm) }}</textarea>
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-primary">Save Exercise</button>
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
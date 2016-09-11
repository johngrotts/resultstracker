@extends('../layouts.app')
<!-- workouts create file -->
@section('content')
	<h1> Create a Workout</h1>

	<form method="POST" action="/workouts" class="workout-form">
	{{ csrf_field() }} {{-- token that protects the form --}}
		<div class="form-group">
			<label for="client_id">Client</label> 
			<select class="form-control" name="client_id"> 
			<option value=''></option>
			@foreach ($users as $user)
				<option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
			@endforeach
			</select>
		</div>
		<div class="form-group">
				<label for="trainer_comm">Trainer Comment</label> 
			<textarea name="trainer_comm" class="form-control">{{ old('trainer_comm') }}</textarea>
		</div>
		<div class="form-group">
			<h1>Add an Exercise:</h1>
			<div>
	    		<label for="exer_type">What Activity?*</label> 
				<textarea name="exercises[0][exer_type]" class="form-control" placeholder="What Activity?">{{ old('exer_type') }}</textarea>
			</div>
			<div class="form-group">
	    		<label for="sets">Sets*</label> 
				<input type="number" name="exercises[0][sets]" class="form-control" min="0" value="{{ old('sets') }}"  placeholder="Sets">
			</div>

			<div class="form-group">
	    		<label for="reps">Reps</label> 
				<input type="number" name="exercises[0][reps]" class="form-control" min="0" value="{{ old('reps') }}"  placeholder="Reps">
			</div>

			<div class="form-group">
	    		<label for="start_weight">Starting Weight</label> 
				<input type="number" name="exercises[0][start_weight]" class="form-control" min="0" value="{{ old('start_weight') }}"  placeholder="Start Weight">
			</div>
			<div class="form-group">
				<label for="exer_comm">Trainer Notes</label>   
				<textarea name="exercises[0][exer_comm]" class="form-control"  placeholder="Trainer Notes">{{ old('exer_comm') }}</textarea>
			</div>
		</div>
		<div class="form-group">
			<h1>Add an Exercise:</h1>
			<div>
	    		<label for="exer_type">What Activity?*</label> 
				<textarea name="exercises[1][exer_type]" class="form-control" placeholder="What Activity?">{{ old('exer_type') }}</textarea>
			</div>
			<div class="form-group">
	    		<label for="sets">Sets*</label> 
				<input type="number" name="exercises[1][sets]" class="form-control" min="0" value="{{ old('sets') }}"  placeholder="Sets">
			</div>

			<div class="form-group">
	    		<label for="reps">Reps</label> 
				<input type="number" name="exercises[1][reps]" class="form-control" min="0" value="{{ old('reps') }}"  placeholder="Reps">
			</div>

			<div class="form-group">
	    		<label for="start_weight">Starting Weight</label> 
				<input type="number" name="exercises[1][start_weight]" class="form-control" min="0" value="{{ old('start_weight') }}"  placeholder="Start Weight">
			</div>
			<div class="form-group">
				<label for="exer_comm">Trainer Notes</label>   
				<textarea name="exercises[1][exer_comm]" class="form-control"  placeholder="Trainer Notes">{{ old('exer_comm') }}</textarea>
			</div>
		</div>
		<div class="form-group">
		* Indicates Required
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-primary">Add Workout</button>
		</div>
	</form>

	<!-- displays errors -->
	@if (count($errors))
		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	@endif

@endsection

<!--
<table class="table-condensed">	
<thead><tr><th colspan=3><h1>Add an Exercise:</h1></th></tr></thead>	
<tbody>
	<tr><td colspan=3><div class="form-group"><label for="exer_type">What Activity?*</label> 
		<textarea name="exercises[0][exer_type]" class="form-control" placeholder="What Activity?">{{ old('exer_type') }}</textarea></div></td></tr>
	<tr><td><div class="form-group"><label for="sets">Sets*</label> 
		<input type="number" name="exercises[0][sets]" class="form-control" min="0" value="{{ old('sets') }}"  placeholder="Sets"></div></td>
		<td><div class="form-group"><label for="reps">Reps</label> 
			<input type="number" name="exercises[0][reps]" class="form-control" min="0" value="{{ old('reps') }}"  placeholder="Reps"></div></td>
		<td><div class="form-group"><label for="start_weight">Starting Weight</label> 
			<input type="number" name="exercises[0][start_weight]" class="form-control" min="0" value="{{ old('start_weight') }}"  placeholder="Start Weight"></div></td>	
	</tr>
	<tr><td colspan=3><div class="form-group"><label for="exer_comm">Trainer Notes</label><textarea name="exercises[0][exer_comm]" class="form-control"  placeholder="Trainer Notes">{{ old('exer_comm') }}</textarea></div></td></tr>
</tbody>
</table>

<script>
	function rowGenerator() {

    this.addRow = function () {
      var output = '';
      output += '<div class="add-exercise">';
      output += '<table class="table-condensed">';
      output += '<thead><tr><th colspan=3><h1>Add an Exercise:</h1></th></tr></thead>';
      output += '<tbody>';
      output += '<div class="controls">';
      output += '<tr><td colspan=3><div class="form-group"><label for="exer_type">What Activity?*</label>';
      output += '<textarea name="exercises[][exer_type]" class="form-control" placeholder="What Activity?">{{ old('exer_type') }}</textarea></div></td></tr>';
      output += '<tr><td><div class="form-group"><label for="sets">Sets*</label>';
      output += '<input type="number" name="exercises[][sets]" class="form-control" min="0" value="{{ old('sets') }}"  placeholder="Sets"></div></td>';
      output += '<td><div class="form-group"><label for="reps">Reps</label>';
      output += '<input type="number" name="exercises[][reps]" class="form-control" min="0" value="{{ old('reps') }}"  placeholder="Reps"></div></td>';
      output += '<td><div class="form-group"><label for="start_weight">Starting Weight</label>';
      output += '<input type="number" name="exercises[][start_weight]" class="form-control" min="0" value="{{ old('start_weight') }}"  placeholder="Start Weight"></div></td>';
      output += '</tr>';
      output += '<tr><td colspan=3><div class="form-group"><label for="exer_comm">Trainer Notes</label><textarea name="exercises[][exer_comm]" class="form-control"  placeholder="Trainer Notes">{{ old('exer_comm') }}</textarea></div></td></tr>';
      output += '</tbody></table><input type="button" class="remove-row" value="-" /></div>';
      return output;
    };

    this.removeRow = function (evt) {
      $(evt.target).closest('.add-exercise').remove();
    };
  }


  $(function () {
    var rows = new rowGenerator();

    /*
     BINDINGS
     */
    $('.add-more').click(function () {
      $('.workout-form').append(rows.addRow());
    });
    $(document).on('click', '.remove-row', function (evt) {
      rows.removeRow(evt);
    });
    /*
     END BINDINGS
     */
  });
</script>
-->
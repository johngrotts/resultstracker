@extends('../layouts.app')
<!-- workouts create file -->
@section('content')
	<h1> Create a Workout</h1>

	<form method="POST" action="/workouts" class="workout-form" id="exerciseForm">
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
		    <label class="col-xs-1 control-label">Exercise</label>
		    <div class="col-xs-3">
		    	<input type="text" class="form-control" name="exercises[0][activity]" placeholder="Activity" />
		    </div>
		    <div class="col-xs-1">
		    	<input type="number" class="form-control" name="exercises[0][sets]" placeholder="Sets" />
		    </div>
		    <div class="col-xs-1">
		    	<input type="number" class="form-control" name="exercises[0][reps]" placeholder="Reps" />
		    </div>
		    <div class="col-xs-1">
		    	<input type="number" class="form-control" name="exercises[0][start_weight]" placeholder="Weight" />
		    </div>
		    <div class="col-xs-3">
		    	<input type="text" class="form-control" name="exercises[0][exer_comm]" placeholder="Comment" />
		    </div>
		    <div class="col-xs-1">
		    	<button type="button" class="btn btn-default addButton"><i class="fa fa-plus"></i></button>
		    </div>
		</div>

		<!-- The template for adding new field -->
		<div class="form-group hide" id="exerciseTemplate">
		    <div class="col-xs-4 col-xs-offset-1">
		    <div class="col-xs-3">
		    	<input type="text" class="form-control" name="activity" placeholder="Activity" />
		    </div>
		    <div class="col-xs-1">
		    	<input type="number" class="form-control" name="sets" placeholder="Sets" />
		    </div>
		    <div class="col-xs-1">
		    	<input type="number" class="form-control" name="reps" placeholder="Reps" />
		    </div>
		    <div class="col-xs-1">
		    	<input type="number" class="form-control" name="start_weight" placeholder="Weight" />
		    </div>
		    <div class="col-xs-3">
		    	<input type="text" class="form-control" name="exer_comm" placeholder="Comment" />
		    </div>
		    <div class="col-xs-1">
		    	<button type="button" class="btn btn-default removeButton"><i class="fa fa-minus"></i></button>
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
<!-- USES http://formvalidation.io/ -->
<script>
$(document).ready(function() {
  var activityValidators = {
      row: '.col-xs-4', // The title is placed inside a <div class="col-xs-4"> element
      validators: {
        notEmpty: {
          message: 'Activity is required'
        }
      }
    },
    setsValidators = {
      row: '.col-xs-4',
      validators: {
        notEmpty: {
          message: 'Sets are required'
        },
      }
    },
    exerciseIndex = 0;

  $('#exerciseForm')
    .formValidation({
      framework: 'bootstrap',
      icon: {
        valid: 'glyphicon glyphicon-ok',
        invalid: 'glyphicon glyphicon-remove',
        validating: 'glyphicon glyphicon-refresh'
      },
      fields: {
        'exercises[0].activity': activityValidators,
        'exercises[0].sets': setsValidators
      }
    })

  // Add button click handler
  .on('click', '.addButton', function() {
    exerciseIndex++;
    var $template = $('#exerciseTemplate'),
      $clone = $template
      .clone()
      .removeClass('hide')
      .removeAttr('id')
      .attr('data-exercise-index', exerciseIndex)
      .insertBefore($template);

    // Update the name attributes
    $clone
      .find('[name="title"]').attr('name', 'exercise[' + exerciseIndex + '][activity]').end()
      .find('[name="sets"]').attr('name', 'exercise[' + exerciseIndex + '][sets]').end()
      .find('[name="reps"]').attr('name', 'exercise[' + exerciseIndex + '][reps]').end()
      .find('[name="start_weight"]').attr('name', 'exercise[' + exerciseIndex + '][start_weight]').end()
      .find('[name="exer_comm"]').attr('name', 'exercise[' + exerciseIndex + '][exer_comm]').end();

    // Add new fields
    // Note that we also pass the validator rules for new field as the third parameter
    $('#exerciseForm')
      .formValidation('addField', 'exercise[' + exerciseIndex + '].title', titleValidators)
      .formValidation('addField', 'exercise[' + exerciseIndex + '].isbn', isbnValidators);
  })

  // Remove button click handler
  .on('click', '.removeButton', function() {
    var $row = $(this).parents('.form-group'),
      index = $row.attr('data-exercise-index');

    // Remove fields
    $('#exerciseForm')
      .formValidation('removeField', $row.find('[name="exercise[' + index + '].title"]'))
      .formValidation('removeField', $row.find('[name="exercise[' + index + '].isbn"]'))
      .formValidation('removeField', $row.find('[name="exercise[' + index + '].price"]'));

    // Remove element containing the fields
    $row.remove();
  });
});
</script>

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


-->
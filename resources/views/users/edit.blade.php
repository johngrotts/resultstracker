@extends('../layouts.app')
<!-- users show file -->
@section('content')
	<h1>
	@if ($user->id == Auth::user()->id)
	Hey, It's you!
	@else
	{{ $user->getFullName() }}
	@endif
	</h1>
	<div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Active?</th>
                    <th>Date/Time Added</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td>{{ $user->email }}</td>
	                <td>
		                @if ($user->is_active == true)
		                	Yes
		                @else
		                	No
		                @endif
	                </td>
                    <td>{{ $user->created_at->format('F d, Y h:ia') }}</td>
                </tr>
            </tbody>
        </table>
	</div>
	<div class="panel-heading"><h1>User Roles:</h1></div>
		<div class="panel-body">
		<ul>
        	@foreach ($user->roles()->get() as $uRole)
        		<li>{{ $uRole->label }}</li>
        	@endforeach
        </ul>
		@foreach ($roles as $role)
		@if ($role->name == 'root')
        @else
        	<form method="POST" action="/users/{{ $user->id }}/role/{{ $role->id }}">
				{{ method_field('PATCH') }} {{-- allows PATCH request on older browsers --}}
				{{ csrf_field() }} {{-- token that protects the form --}}
				<div class="form-group">
					<button type="submit" class="btn btn-primary" name="{{ $role->id }}">
	                @if (!$user->hasRole($role->name))
	                	Make {{ $user->first_name }} a {{ $role->label }}
	                @else
	                	Remove {{ $role->label }} Role from  {{ $user->first_name }}
	                @endif
	                </button>
				</div>
			</form>
        @endif
        @endforeach
		</div>
	@can('edit_users')
		<div class="panel-body">
			<h2>Edit This User</h2>
			<form method="POST" action="/users/{{ $user->id }}">
			{{ method_field('PATCH') }} {{-- allows PATCH request on older browsers --}}
			{{ csrf_field() }} {{-- token that protects the form --}}
				<div class="form-group">
					Is the user active? 
					<select class="form-control" name="is_active">
						<option value="1" {{ $isActive == 'TRUE' ? 'selected="selected"' : '' }}>Yes</option>
						<option value="0" {{ $isActive == 'FALSE' ? 'selected="selected"' : '' }}>No</option>
					</select>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Update User</button>
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
	    </div>
	@endcan

@endsection
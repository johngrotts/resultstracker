@extends('../layouts.app')
<!-- users show file -->
@section('content')
	@if ($user->id == Auth::user()->id)
	<h1>Hey, It's you!</h1>
	@else
	<h1>{{ $user->getFullName() }}</h1>
	@endif

	<div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Active?</th>
                    <th>Date/Time Added</th>
                    @can ('edit_users')
                    	<th></th>
                    @endcan
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
                    @can ('edit_users')
	                    <td>
	                        <a href="/users/{{ $user->id }}/edit" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>
	                    </td>
                    @endcan
                </tr>
            </tbody>
        </table>
	</div>
	@can('edit_users')
		<h1>User Roles:</h1>
		<div class="table-responsive">
	        <table class="table table-bordered table-striped">
	            <tr>
	                @if ($user->hasRole('trainer'))
	                	<th>Trainer</th>
	                @endif
	                @if ($user->hasRole('manager'))
	                	<th>Manager</th>
	                @endif
	                @if ($user->hasRole('admin'))
	                	<th>Administrator</th>
	                @endif
	            </tr>
	        </table>
		</div>
	@endcan

@endsection


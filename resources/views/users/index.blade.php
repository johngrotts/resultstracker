@extends('../layouts.app')
<!-- users index file -->
@section('content')
	<h1><i class="fa fa-users"></i> User Administration</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Active?</th>
                    <th>Date/Time Added</th>
                    @can ('edit_users')
                    	<th></th>
                    @endcan
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->getFullName() }}</td>
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
                @endforeach
            </tbody>

        </table>
	</div>
@endsection
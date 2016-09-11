@extends('../layouts.app')
<!-- profile file -->
@section('content')
	<h1>{{ Auth::user()->getFullName() }}</h1>
	{{ Auth::user()->email }}

	
@endsection
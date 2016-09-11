@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Home</div>
                <div class="panel-body">
                You are logged in!<br>
                Time to get the results you deserve!<br>
                <h3>Assigned Roles:</h2>
                @foreach (Auth::user()->roles as $role)
                    <li class="list-group-item">{{ $role->label }}</li>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

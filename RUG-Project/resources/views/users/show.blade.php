@extends('layouts.app')

@section('content')
    <h1>User Details</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $user->name }}</h5>
            <p class="card-text">Email: {{ $user->email }}</p>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to Users List</a>
        </div>
    </div>
@endsection
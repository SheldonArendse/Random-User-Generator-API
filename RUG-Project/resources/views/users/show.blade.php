@extends('layouts.app')

@section('content')
    <h1>User Details</h1>

    <div class="card">
        <div class="card-body">
            <p><strong>Picture:</strong></p>
            <img src="{{ $user->picture }}" alt="{{ $user->name }} {{ $user->surname }} picture" width="150" height="150">

            <p><strong>Title:</strong>
                 {{ $user->title }}
            </p>

            <p><strong>Name:</strong> 
                {{ $user->name }}
            </p>

            <p><strong>Surname:</strong> 
                {{ $user->surname }}
            </p>

            <p><strong>Email:</strong> 
                {{ $user->email }}
            </p>

            <p><strong>Phone:</strong> 
                {{ $user->phone }}
            </p>

            <button type="button" class="btn-style-1" onclick="window.location='{{ route('users.index') }}'">
                Back to Users List
            </button>
        </div>
    </div>
@endsection

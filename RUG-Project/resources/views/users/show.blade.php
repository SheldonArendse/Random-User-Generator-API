@extends('layouts.app')

@section('content')
    <h1 id="details-heading">User Details</h1>

    <div class="pfp-container">
        <div class="card">
            <div class="card-body">
                <div class="profile-image">
                    @if ($user->picture)
                    <img src="{{ $user->picture }}" id="show-pfp" alt="{{ $user->name }} {{ $user->surname }}">
                @else
                    <img src="{{ asset('images/default-pfp.jpg') }}" id="show-pfp" alt="Default Image">
                @endif

                </div>
                <div class="profile-details">
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

                    <a href="{{ route('users.index', $user->id) }}" class="btn-style-1">Back</a>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn-style-1">Edit</a>
                </div>
            </div>
        </div>
    </div>
@endsection

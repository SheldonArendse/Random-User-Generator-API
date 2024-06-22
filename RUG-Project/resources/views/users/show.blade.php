@extends('layouts.app')
    <head>
        <title>{{ $user->name }} {{ $user->surname }} | View Profile</title>
    </head>

@section('content')

    <h1 id="details-heading">{{ $user->name }} {{ $user->surname }}</h1>

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

    <style>
        body {
            height: 100vh;
            margin: 0;
            overflow: hidden;
            background: 
                linear-gradient(to right, rgba(255,0,0,0.5), rgba(0,0,255,0.5)),
                radial-gradient(circle at center, rgba(0,0,255,0.5), rgba(0, 200, 255, 0.5));
            background-blend-mode: screen;
        }
    </style>
@endsection

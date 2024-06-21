@extends('layouts.app')

@section('content')
    <div class="edit-form">
        <h1 id="edit-user-title">Edit Profile</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title" id="label-style-1">Title</label>
                <select name="title" class="form-control" id="title-cbx" required>
                    <option value="Mr" {{ $user->title == 'Mr' ? 'selected' : '' }}>Mr</option>
                    <option value="Ms" {{ $user->title == 'Ms' ? 'selected' : '' }}>Ms</option>
                    <option value="Mrs" {{ $user->title == 'Mrs' ? 'selected' : '' }}>Mrs</option>
                    <option value="Dr" {{ $user->title == 'Dr' ? 'selected' : '' }}>Dr</option>
                </select>
            </div>

            <div class="form-group" id="form-group-edit">
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                <label for="name" id="label-style-1">First Name:</label>
            </div>

            <div class="form-group" id="form-group-edit">
                <input type="text" name="surname" id="surname" class="form-control" value="{{ old('surname', $user->surname) }}" required>
                <label for="surname" id="label-style-1">Surname:</label>
            </div>

            <div class="form-group" id="form-group-edit">
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                <label for="email" id="label-style-1">Email:</label>
            </div>

            <div class="form-group" id="form-group-edit">
                <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $user->phone) }}" required>
                <label for="phone" id="label-style-1">Phone:</label>
            </div>

            <button type="submit" class="btn-style-1" id="btn-update">Update</button>
        </form>
    </div>
@endsection

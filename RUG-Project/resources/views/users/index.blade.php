@extends('layouts.app')

@section('content')
    <h1>Users List</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <table class="table">
        <thead>
            <tr>
                <th>Picture</th>
                <th>Title</th>
                <th>Name</th>
                <th>Surname</th>
                <th>Email</th>
                <th>Phone</th> 
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td><img src="{{ $user->picture }}" id="pfp" alt="{{ $user->name }} {{ $user->surname }}" width="80" height="80"></td>
                    <td>{{ $user->title }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->surname }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>

                    <td>
                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <button type="button" class="btn-style-1" onclick="window.location='{{ route('users.create') }}'">
        Add a User
    </button>
@endsection



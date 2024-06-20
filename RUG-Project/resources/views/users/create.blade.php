@extends('layouts.app')

@section('content')
    <div class="form-container">
        <h1>Create User</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <select name="title" class="form-control" id="title-cbx" required>
                    <option value="Mr">Mr</option>
                    <option value="Ms">Ms</option>
                    <option value="Mrs">Mrs</option>
                    <option value="Dr">Dr</option>
                </select>
            </div>
            
            <div class="form-group">
                <input type="text" name="name" class="form-control" required>
                <label for="name">First Name</label>
            </div>

            <div class="form-group">
                <input type="text" name="surname" class="form-control" required>
                <label for="surname">Surname</label>
            </div>

            <div class="form-group">  
                <input type="email" name="email" class="form-control" required>
                <label for="email">Email</label>
            </div>

            <div class="form-group">  
                <input type="text" name="phone" class="form-control" required>
                <label for="phone">Phone</label>
            </div>

        <div class="button-container">
                <button type="submit" class="btn-style-1">Create User</button>
            </form>

            <form action="{{ route('users.storeRandom') }}" method="POST">
                @csrf
                <button type="submit" class="btn-style-1">Add Random User</button>
            </form>
        </div>
    </div>
@endsection

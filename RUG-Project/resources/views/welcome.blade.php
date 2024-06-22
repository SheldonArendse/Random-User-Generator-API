<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{-- link css  --}}
        <link rel="stylesheet" href="css/nav.css">
        <link rel="stylesheet" href="css/welcome.css">

        <title>Random User | Welcome</title>

        {{-- embedded css --}}
        <style>
            body {
            background-image: url('{{ asset('images/welcome-bg3.jpg') }}');
            background-size: cover; 
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }
        </style>
    </head>

    <body>
        <header>
            <h2 class="logo">Random User Project</h2>
            <nav class="navbar">
                <a href="#" onclick="window.location='{{ route('users.index') }}'">View Users</a>
                <a href="#" onclick="window.location='{{ route('users.create') }}'">Create User</a>
            </nav>
        </header>

        <div class="welcome-box">
            <h1 class="title">Welcome to Random User Generator</h1>
            <p>This application allows you to effortlessly manage and view user 
                profiles with ease. Whether you're looking to create a new user, 
                view detailed profiles, or generate random users for testing, 
                we've got you covered.
                <br> <br>
                <div class="features-title">
                    <strong><u>Features Include:</u></strong>
                </div>
                <div class="features">
                    <br>- Create User Profiles
                    <br>- View User Profiles
                    <br>- Generate Random Users
                    <br>- Edit Profiles
                </div>
            </p>

            
        </div>

    </body>
</html>

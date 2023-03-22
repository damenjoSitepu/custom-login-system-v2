<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
    <title>{{ $title }}</title>
</head>
<body>
    {{-- Container --}}
    <div class="app-container">
        <h1>CLS</h1>
        <p class="app-container-title">Login Authentification</p>
        <hr>

        {{-- Username input --}}
        <div class="app-input">
            <label for="username">Username</label>
            <input type="text" id="username" placeholder="damenjo*">
        </div>

        {{-- Password input --}}
        <div class="app-input">
            <label for="password">Password</label>
            <input type="text" id="password" placeholder="Your Password*">
        </div>

        <button class="app-button">Login</button>
        
        <a class="app-link" href="{{ route('application.guest.auth.registration.view') }}">Don't have account? Register here...</a>
    </div>
</body>
</html>
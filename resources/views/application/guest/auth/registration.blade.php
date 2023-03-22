<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/registration.css') }}">
    <title>{{ $title }}</title>
</head>
<body>
    {{-- Container --}}
    <div class="app-container">
        <h1>CLS</h1>
        <p class="app-container-title">Registration Authentification</p>
        <hr>

        {{-- Fullname Input --}}
        <div class="app-input">
            <label for="full_name">Full Name</label>
            <input type="text" id="full_name" placeholder="Damenjo Sitepu*">
        </div>

        {{-- Email Input --}}
        <div class="app-input">
            <label for="email">Email</label>
            <input type="email" id="email" placeholder="damenjos@gmail.com*">
        </div>

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

        <button class="app-button">Sign Up</button>
        
        <a class="app-link" href="{{ route('application.guest.auth.login.view') }}">Have an account? Login here...</a>
    </div>
</body>
</html>
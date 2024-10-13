<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('assets/website/css/login.css') }}">
</head>
<body>
    <div class="box">
        <form action="{{route('add-user')}}" method="POST">
            @csrf
            <div class="input-box">
                <h2>Sign Up</h2>
                <input type="text" name="name" required>
                <span>Name</span>
                <i></i>
            </div>
            <div class="input-box">
                <input type="email" name="email" required>
                <span>Email</span>
                <i></i>
            </div>
            <div class="input-box">
                <input type="password" name="password" required>
                <span>Password</span>
                <i></i>
            </div>
            <input type="submit" value="Register">
            <div class="links">
                <a href="{{route('login')}}">Login</a>
            </div>
        </form>
    </div>
</body>
</html>

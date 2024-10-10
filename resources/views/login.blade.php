<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="{{ asset('assets/website/css/login.css') }}">
</head>
<body>
    <div class="box">
        <form action="{{route('check-users')}}" method="POST">
            @csrf
            <div class="input-box">
                <h2>Sign In</h2>
                <input type="email" name="email" required>
                <span>Email</span>
                <i></i>
            </div>
            <div class="input-box">
                <input type="password" name="password" required>
                <span>Password</span>
                <i></i>
            </div>
            <input type="submit" value="Login">
            <div class="links">
                <a href="#">Sign Up</a>
            </div>
        </form>
    </div>
</body>
</html>

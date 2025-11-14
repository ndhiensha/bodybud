<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="/css/auth.css">
</head>
<body>

    <div class="container">
        <div class="card">
            <h2>Create Account</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <input type="email" name="email" placeholder="Email">

            <input type="text" name="name" placeholder="Name">

            <input type="password" name="password" placeholder="Password">

            <input type="password" name="password_confirmation" placeholder="Confirm Password">

            <button type="submit">Sign Up</button>
        </form>

        <p class="small-link">
            Already have an account? <a href="/login">Login</a>
        </p>

            
        </div>
    </div>
    

</body>
</html>

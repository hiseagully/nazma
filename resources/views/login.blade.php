<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/signup.css') }}">
</head>
<body>
    <div class="background-wrapper">
        <img src="{{ asset('images/left-image.png') }}" class="bg-left" alt="Left Background">
        
        <main>
            <h1>Login</h1>
            <form action="{{ route('signup.store') }}" method="POST">
                @csrf
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login now!</button>
            </form>
            <p>or</p>
            <!-- Tambahkan tombol Login dengan Google -->
            <div class="google-login">
                <a href="{{ route('google.login') }}" class="google-btn">
                    <img src="{{ asset('images/google-icon.png') }}" alt="Google Icon">
                    Login with Google
                </a>
            </div>

            <p>Don't have an account? <a href="/signup">Sign Up</a></p>
        </main>

        <img src="{{ asset('images/right-image.png') }}" class="bg-right" alt="Right Background">
    </div>
</body>
</html>
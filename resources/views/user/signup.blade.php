<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/signup.css') }}">
</head>
<body>
    <div class="background-wrapper">
        <img src="{{ asset('images/left-image.png') }}" class="bg-left" alt="Left Background">
        
        <main>
            <h1>Sign Up</h1>
            <form action="{{ route('signup.store') }}" method="POST">
                @csrf
                <input type="text" name="name" placeholder="Full Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="text" name="phone" placeholder="Phone" required>
                <button type="submit">Sign Up now!</button>
            </form>

            <div class="google-signup">
                <a href="{{ route('google.signup') }}" class="google-btn">
                    <img src="{{ asset('images/google-icon.png') }}" alt="Google Icon">
                    Sign Up with Google
                </a>
            </div>
            
            <p>Already have an account? <a href="/login">Log In</a></p>
        </main>

        <img src="{{ asset('images/right-image.png') }}" class="bg-right" alt="Right Background">
    </div>
</body>
</html>

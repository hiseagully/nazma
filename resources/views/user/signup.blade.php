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
        <main>
            <h1>Sign Up</h1>

            @if(session('success'))
                <div class="notif-success">
                    <svg class="icon-success" fill="none" viewBox="0 0 24 24" stroke="green" width="24" height="24">
                        <circle cx="12" cy="12" r="10" stroke="green" stroke-width="2" fill="#d1fae5"/>
                        <path stroke="green" stroke-width="2" d="M7 13l3 3 7-7"/>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="notif-error">
                    <span class="notif-error-icon">&#9888;</span>
                    <span class="notif-error-text">{{ implode(' ', $errors->all()) }}</span>
                </div>
            @endif

            <form action="{{ route('signup.store') }}" method="POST">
                @csrf
                <input type="text" name="name" placeholder="Full Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="text" name="phone" placeholder="Phone" required>
                <button type="submit">Sign Up now!</button>
                <p>or</p>
            </form>
            <div class="google-signup">
                <a href="{{ route('google.signup') }}" class="google-btn">
                    <img src="{{ asset('images/google-icon.png') }}" alt="Google Icon">
                    Sign Up with Google
                </a>
            </div>        
            <p>Already have an account? <a href="/login">Log In</a></p>
        </main>
    </div>
</body>
</html>
\
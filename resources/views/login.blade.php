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
        <main>
            <h1>Login</h1>

            {{-- Notif Success/Error --}}
            @if(session('success'))
                <div class="notif-success">
                    <svg class="icon-success" fill="none" viewBox="0 0 24 24" stroke="green" width="24" height="24">
                        <circle cx="12" cy="12" r="10" stroke="green" stroke-width="2" fill="#d1fae5"/>
                        <path stroke="green" stroke-width="2" d="M7 13l3 3 7-7"/>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="notif-error">
                    <span class="notif-error-icon">&#9888;</span>
                    <span class="notif-error-text">{{ session('error') }}</span>
                </div>
            @endif

            <form action="{{ route('login.authenticate') }}" method="POST">
                @csrf
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login now!</button>
                <p>or</p>
            </form>
            <!-- Tambahkan tombol Login dengan Google -->
            <div class="google-login">
                <a href="{{ route('google.login') }}" class="google-btn">
                    <img src="{{ asset('images/google-icon.png') }}" alt="Google Icon">
                    Login with Google
                </a>
            </div>
            <p>Don't have an account? <a href="/signup">Sign Up</a></p>
        </main>
    </div>
</body>
</html>
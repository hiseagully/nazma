<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <style>body { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-8">
        <h2 class="text-2xl font-bold text-center text-indigo-600 mb-6">Admin Login</h2>
        <form method="POST" action="/loginadmin">
            <div class="mb-4">
                <label class="block text-gray-700 mb-2" for="username">Username</label>
                <input class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-indigo-400" type="text" id="username" name="username" required />
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 mb-2" for="password">Password</label>
                <input class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-indigo-400" type="password" id="password" name="password" required />
            </div>
            <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 rounded transition duration-200" type="submit">Login</button>
        </form>
        <p class="mt-4 text-center text-sm text-gray-600">Belum punya akun? <a href="/signupadmin" class="text-indigo-600 hover:underline">Daftar di sini</a></p>
    </div>
</body>
</html>

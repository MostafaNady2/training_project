<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 h-screen flex items-center justify-center">
    <div class="bg-white shadow-lg rounded-2xl p-10 text-center w-[350px]">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Welcome</h1>
        <p class="text-gray-600 mb-8">Please login or create an account to continue.</p>
        
        <div class="flex flex-col gap-4">
            <a href="{{ route('login') }}" 
               class="px-6 py-3 bg-indigo-600 text-white rounded-xl font-semibold shadow hover:bg-indigo-700 transition">
               Login
            </a>

            <a href="{{ route('register') }}" 
               class="px-6 py-3 bg-gray-200 text-gray-800 rounded-xl font-semibold shadow hover:bg-gray-300 transition">
               Register
            </a>
        </div>
    </div>
</body>
</html>
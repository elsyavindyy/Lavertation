<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex justify-center items-center h-screen">

    <div class="bg-white p-8 rounded-xl shadow-lg w-96">
        <h2 class="text-[40px] font-bold mb-6 text-center">LOGIN</h2>
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Username --}}
            <div class="mb-4">
                <label for="username" class="block text-gray-700 font-semibold mb-2">Username</label>
                <input id="username" type="text" name="username" value="{{ old('username') }}" required autofocus
                    class="w-full px-3 py-2 border rounded-lg bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-400">
                @error('username')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-6">
                <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
                <input id="password" type="password" name="password" required
                    class="w-full px-3 py-2 border rounded-lg bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-400">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tombol --}}
            <div>
                <button type="submit" 
                    class="w-full bg-gray-800 text-white py-2 px-4 rounded-lg hover:bg-gray-700 transition">
                    Login
                </button>
            </div>
        </form>

        <p class="text-center text-sm mt-4">
            Don’t have an account? 
            <a href="{{ route('register') }}" class="text-[#FFA100] hover:underline">Register</a>
        </p>
    </div>

</body>
</html>

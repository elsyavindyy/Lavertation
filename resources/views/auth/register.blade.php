<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 flex justify-center items-center min-h-screen">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md">
        <!-- Title -->
        <h1 class="text-4xl font-bold text-center mb-4">REGISTER</h1>

        <!-- Form -->
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Username -->
            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <input 
                    id="username" 
                    type="text" 
                    name="username" 
                    value="{{ old('username') }}" 
                    required 
                    class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-indigo-500"
                >
                @error('username')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input 
                    id="email" 
                    type="email" 
                    name="email" 
                    value="{{ old('email') }}" 
                    required 
                    class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-indigo-500"
                >
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input 
                    id="password" 
                    type="password" 
                    name="password" 
                    required 
                    class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-indigo-500"
                >
                @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-6">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input 
                    id="password_confirmation" 
                    type="password" 
                    name="password_confirmation" 
                    required 
                    class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-indigo-500"
                >
            </div>

            <!-- Submit -->
            <button 
                type="submit" 
                class="w-full bg-gray-800 text-white py-2 px-4 rounded-lg hover:bg-gray-700 transition"
            >
                Register
            </button>
        </form>

        <!-- Link to login -->
        <p class="text-center text-sm mt-4">
            Already have an account? 
            <a href="{{ route('login') }}" class="text-[#FFA100] hover:underline">Login</a>
        </p>

    </div>
</body>
</html>

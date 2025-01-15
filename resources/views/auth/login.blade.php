<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Tailwind CSS dari CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .logo {
            width: auto;
            height: auto;
        }
        
        /* Optional: styling untuk container */
        .logo-container {
            display: flex;
            justify-content: center;
            padding: 2px;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full bg-white p-6 rounded-lg shadow-md">
            <div class="logo-container">
                <img src="{{ asset('images/apotekin-logo2.svg') }}" alt="Logo Apotekin" class="logo">
            </div>
            
            <form class="mt-4 space-y-3" action="#" method="POST">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" name="email" type="email" required 
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 
                        focus:outline-none focus:ring-black focus:border-black sm:text-sm" 
                        placeholder="Enter your email">
                </div>
                
                @error('email')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" name="password" type="password" required 
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 
                        focus:outline-none focus:ring-black focus:border-black sm:text-sm"
                        placeholder="Enter your password">
                </div>
                
                @error('password')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember_me" name="remember_me" type="checkbox" 
                            class="h-4 w-4 text-black border-gray-300 rounded focus:ring-black">
                        <label for="remember_me" class="ml-2 text-sm text-gray-900">Remember me</label>
                    </div>
                    <a href="#" class="text-sm text-gray-900 hover:underline">Forgot password?</a>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" 
                        class="w-full py-2 px-4 bg-black text-white rounded-md hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black text-sm font-medium">
                        Sign In
                    </button>
                </div>
            </form>

            <!-- Signup Link -->
            <p class="mt-3 text-center text-sm text-gray-600">
                Don’t have an account? 
                <a href="{{ route('register') }}" class="font-medium text-black hover:underline">Sign up</a>
            </p>
        </div>

    </div>
</body>
</html>
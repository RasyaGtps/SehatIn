<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SehatIn</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        * {
            font-family: 'Manrope', sans-serif;
        }
    </style>
</head>
<body>
    <div class="flex min-h-screen">
        <!-- Left Side - Login Form -->
        <div class="w-full lg:w-1/2 p-4 lg:p-12 xl:p-16 flex items-center">
            <div class="w-full max-w-md mx-auto">
                <div class="text-center mb-8">
                    <img src="{{ asset('images/Sehatin 1.png') }}" alt="SehatIn Logo" class="w-16 h-16 mx-auto mb-4">
                    <h1 class="text-3xl font-bold mb-2">Welcome to Sehatin👋</h1>
                    <p class="text-gray-600">Kindly fill in your details below to create an account</p>
                </div>

                <form action="{{ route('login') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-gray-600 mb-2">Email Address</label>
                        <input type="email" name="email" placeholder="Daphne Smith" class="w-full px-4 py-3 rounded-lg border focus:outline-none focus:ring-2 focus:ring-[#EC744A]" required>
                    </div>

                    <div>
                        <label class="block text-gray-600 mb-2">Password</label>
                        <div class="relative">
                            <input type="password" name="password" placeholder="************" class="w-full px-4 py-3 rounded-lg border focus:outline-none focus:ring-2 focus:ring-[#EC744A]" required>
                            <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-[#CE4846] text-white py-3 rounded-lg font-medium hover:bg-[#b13e3c] transition-colors">
                        Login Here!
                    </button>

                    <p class="text-center text-gray-600">
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="text-[#CE4846] font-medium hover:text-[#b13e3c]">Register</a>
                    </p>

                    <div class="relative my-6">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-4 bg-white text-gray-500">Or</span>
                        </div>
                    </div>

                    <a href="{{ route('google.login') }}" class="flex items-center justify-center gap-2 w-full border rounded-lg px-4 py-3 hover:bg-gray-50 transition-colors">
                        <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" class="w-6 h-6">
                        <span class="text-gray-600">Continue with Google</span>
                    </a>
                </form>
            </div>
        </div>

        <!-- Right Side - Image -->
        <div class="hidden lg:block lg:w-1/2 bg-black">
            <div class="relative h-full">
                <img src="{{ asset('images/03-Sky 2.png') }}" alt="Background" class="absolute inset-0 w-full h-full object-cover opacity-60">
            </div>
        </div>
    </div>
</body>
</html>
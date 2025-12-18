<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | FXFLARE</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-darkbg text-white font-sans antialiased h-screen flex items-center justify-center overflow-hidden relative selection:bg-accent selection:text-white">

    <!-- Background Effects -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none z-0">
        <div class="absolute top-[-20%] left-[-10%] w-[600px] h-[600px] bg-accent/20 rounded-full blur-[100px] animate-pulse"></div>
        <div class="absolute bottom-[-20%] right-[-10%] w-[500px] h-[500px] bg-blue-600/10 rounded-full blur-[100px]"></div>
    </div>

    <!-- Login Card -->
    <div class="relative z-10 w-full max-w-md p-8">
        <div class="bg-darkcard/50 backdrop-blur-xl border border-white/10 rounded-2xl p-8 shadow-2xl relative overflow-hidden group">
            
            <!-- Glow effect on hover -->
            <div class="absolute inset-0 bg-gradient-to-br from-accent/5 to-transparent opacity-0 group-hover:opacity-100 transition duration-500 pointer-events-none"></div>

            <div class="text-center mb-8">
                <a href="/" class="inline-block mb-4">
                    <span class="text-2xl font-bold tracking-wide text-white">
                        FXFLARE <span class="text-accent">ID</span>
                    </span>
                </a>
                <h2 class="text-xl font-semibold text-gray-200">Welcome Back</h2>
                <p class="text-sm text-gray-400 mt-2">Sign in to access premium market insights</p>
            </div>

            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Email -->
                <div>
                    <label for="email" class="block text-xs font-medium text-gray-400 mb-1 uppercase tracking-wider">Email Address</label>
                    <input type="email" name="email" id="email" required autofocus
                           class="w-full bg-darkbg/50 border border-gray-700 text-white rounded-lg px-4 py-3 focus:outline-none focus:border-accent focus:ring-1 focus:ring-accent transition placeholder-gray-600"
                           placeholder="name@example.com" value="{{ old('email') }}">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                   <label for="password" class="block text-xs font-medium text-gray-400 mb-1 uppercase tracking-wider">Password</label>
                    <input type="password" name="password" id="password" required
                           class="w-full bg-darkbg/50 border border-gray-700 text-white rounded-lg px-4 py-3 focus:outline-none focus:border-accent focus:ring-1 focus:ring-accent transition placeholder-gray-600"
                           placeholder="••••••••">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center text-gray-400 hover:text-white cursor-pointer transition">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-gray-700 bg-darkbg focus:ring-accent text-accent mr-2">
                        <span>Remember me</span>
                    </label>
                    <a href="#" class="text-accent hover:text-white transition">Forgot password?</a>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full bg-accent hover:bg-white hover:text-black text-white font-bold py-3 rounded-lg transition duration-300 transform hover:scale-[1.02] shadow-lg shadow-accent/20">
                    Sign In
                </button>

            </form>

            <!-- Register Link -->
            <div class="mt-8 text-center border-t border-gray-700/50 pt-6">
                <p class="text-gray-400 text-sm">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="text-accent font-semibold hover:text-white transition ml-1">Create one</a>
                </p>
            </div>

        </div>
        
        <!-- Back to Home -->
        <div class="text-center mt-6">
            <a href="/" class="text-gray-500 hover:text-white text-sm transition flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back to Home
            </a>
        </div>
    </div>

</body>
</html>
